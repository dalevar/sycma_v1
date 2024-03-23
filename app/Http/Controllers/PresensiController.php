<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Status;
use App\Models\Jurusan;
use App\Models\JadwalSholat;
use Illuminate\Http\Request;
use App\Charts\PresensiChart;
use App\Models\TemporaryRfid;
use App\Models\PresensiSholat;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index(PresensiChart $chart)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        $tanggal = date('Y-m-d');
        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->where('tanggal', $tanggal)->get();
        $totalDataSiswa = $sekolah->siswa->count();
        $totalSiswaLaki = $sekolah->siswa->where('jenis_kelamin', 'L')->count();
        $totalSiswaPerempuan = $sekolah->siswa->where('jenis_kelamin', 'P')->count();

        $kelas = Kelas::where('sekolah_id', $sekolah->id)->get();
        if ($kelas->isEmpty()) {
            $kelas = "Isi data kelas terlebih dahulu";
        }

        $jurusan = Jurusan::where('sekolah_id', $sekolah->id)->get();
        if ($jurusan->isEmpty()) {
            $jurusan = "Isi data jurusan terlebih dahulu";
        }

        $chart = $chart->build();

        return view('dashboard.pages.admin.presensi.presensi', compact('sekolah', 'presensi', 'kelas', 'jurusan', 'chart', 'namaAdmin', 'totalDataSiswa', 'totalSiswaLaki', 'totalSiswaPerempuan'));
    }

    public function presensiGuru(PresensiChart $chart)
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;
        $namaGuru = $guru->name;

        $tanggal = date('Y-m-d');
        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->where('tanggal', $tanggal)->get();
        $totalDataSiswa = $sekolah->siswa->count();
        $totalSiswaLaki = $sekolah->siswa->where('jenis_kelamin', 'L')->count();
        $totalSiswaPerempuan = $sekolah->siswa->where('jenis_kelamin', 'P')->count();

        $kelas = Kelas::where('sekolah_id', $sekolah->id)->get();
        if ($kelas->isEmpty()) {
            $kelas = "Isi data kelas terlebih dahulu";
        }

        $jurusan = Jurusan::where('sekolah_id', $sekolah->id)->get();
        if ($jurusan->isEmpty()) {
            $jurusan = "Isi data jurusan terlebih dahulu";
        }

        $chart = $chart->build();

        return view('dashboard.pages.guru.presensi.presensi', compact('sekolah', 'presensi', 'kelas', 'jurusan', 'chart', 'namaGuru', 'totalDataSiswa', 'totalSiswaLaki', 'totalSiswaPerempuan', 'guru'));
    }

    public function rekapPresensi($bulan, $tahun)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        // Set nilai default untuk bulan dan tahun jika tidak disediakan dalam URL
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        $bulan = max(1, min(12, $bulan));
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $namaBulan = $bulanIndonesia[intval($bulan)];

        // Hitung jumlah hari dalam bulan yang ditentukan
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        // Buat array untuk menyimpan semua tanggal dalam bulan ini
        $tanggalBulan = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggalBulan[] = $i;
        }

        // Ubah format tanggal menjadi 'Y-m-d' untuk menggunakan tipe 'date' di grafik
        $tanggalBulanFormat = [];
        foreach ($tanggalBulan as $tanggal) {
            $tanggalBulanFormat[] = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-' . str_pad($tanggal, 2, '0', STR_PAD_LEFT);
        }

        // Ambil data presensi berdasarkan bulan dan tahun
        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        $jumlahPresensiPerTanggal = [];
        foreach ($tanggalBulanFormat as $tanggal) {
            // Periksa apakah tanggal tersebut bukan hari Jumat, Sabtu, atau Minggu
            $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format ISO 8601 (1 untuk Senin, 7 untuk Minggu)
            if ($hari >= 1 && $hari <= 5) {
                // Jika bukan hari Jumat (5), Sabtu (6), atau Minggu (7)
                // Hitung jumlah presensi sholat untuk tanggal tertentu
                $jumlahPresensiPerTanggal[$tanggal] = $presensi->where('tanggal', $tanggal)->count();
            } else {
                // Jika tanggal tersebut adalah hari Jumat, Sabtu, atau Minggu, set jumlah presensinya menjadi 0
                $jumlahPresensiPerTanggal[$tanggal] = 0;
            }
        }


        $dataGrafik = [];
        foreach ($tanggalBulanFormat as $tanggal) {
            $dataGrafik[] = $jumlahPresensiPerTanggal[$tanggal];
        }
        $dataGrafik = array_map('intval', $dataGrafik); // Konversi semua nilai menjadi bilangan bulat

        // Ambil bulan dan tahun dalam format teks untuk digunakan pada judul grafik
        $namaBulan = $bulanIndonesia[intval($bulan)];
        $judulGrafik = "Grafik Presensi Sholat - $namaBulan $tahun";

        // Ambil semua siswa yang terdaftar di sekolah
        $siswa = Siswa::where('sekolah_id', $sekolah->id)->get();

        return view('dashboard.pages.admin.presensi.rekap-presensi', compact('sekolah', 'presensi', 'namaAdmin', 'bulan', 'tahun', 'siswa', 'namaBulan', 'bulanIndonesia', 'tanggalBulan', 'tanggalBulanFormat', 'judulGrafik', 'dataGrafik', 'jumlahPresensiPerTanggal'));
    }

    public function rekapPresensiGuru($bulan, $tahun)
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;
        $namaGuru = $guru->name;

        // Set nilai default untuk bulan dan tahun jika tidak disediakan dalam URL
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        $bulan = max(1, min(12, $bulan));
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $namaBulan = $bulanIndonesia[intval($bulan)];

        // Hitung jumlah hari dalam bulan yang ditentukan
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        // Buat array untuk menyimpan semua tanggal dalam bulan ini
        $tanggalBulan = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggalBulan[] = $i;
        }

        // Ubah format tanggal menjadi 'Y-m-d' untuk menggunakan tipe 'date' di grafik
        $tanggalBulanFormat = [];
        foreach ($tanggalBulan as $tanggal) {
            $tanggalBulanFormat[] = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-' . str_pad($tanggal, 2, '0', STR_PAD_LEFT);
        }

        // Ambil data presensi berdasarkan bulan dan tahun
        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        $jumlahPresensiPerTanggal = [];
        foreach ($tanggalBulanFormat as $tanggal) {
            // Periksa apakah tanggal tersebut bukan hari Jumat, Sabtu, atau Minggu
            $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format ISO 8601 (1 untuk Senin, 7 untuk Minggu)
            if ($hari >= 1 && $hari <= 5) {
                // Jika bukan hari Jumat (5), Sabtu (6), atau Minggu (7)
                // Hitung jumlah presensi sholat untuk tanggal tertentu
                $jumlahPresensiPerTanggal[$tanggal] = $presensi->where('tanggal', $tanggal)->count();
            } else {
                // Jika tanggal tersebut adalah hari Jumat, Sabtu, atau Minggu, set jumlah presensinya menjadi 0
                $jumlahPresensiPerTanggal[$tanggal] = 0;
            }
        }


        $dataGrafik = [];
        foreach ($tanggalBulanFormat as $tanggal) {
            $dataGrafik[] = $jumlahPresensiPerTanggal[$tanggal];
        }
        $dataGrafik = array_map('intval', $dataGrafik); // Konversi semua nilai menjadi bilangan bulat

        // Ambil bulan dan tahun dalam format teks untuk digunakan pada judul grafik
        $namaBulan = $bulanIndonesia[intval($bulan)];
        $judulGrafik = "Grafik Presensi Sholat - $namaBulan $tahun";

        // Ambil semua siswa yang terdaftar di sekolah
        $siswa = Siswa::where('sekolah_id', $sekolah->id)->get();

        return view('dashboard.pages.guru.presensi.rekap-presensi', compact('sekolah', 'presensi', 'namaGuru', 'bulan', 'tahun', 'siswa', 'namaBulan', 'bulanIndonesia', 'tanggalBulan', 'tanggalBulanFormat', 'judulGrafik', 'dataGrafik', 'jumlahPresensiPerTanggal', 'guru'));
    }


    public function rekapPresensiDetail(Siswa $siswa, $bulan, $tahun)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        // Set nilai default untuk bulan dan tahun jika tidak disediakan dalam URL
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        $bulan = max(1, min(12, $bulan));
        // dd($bulan);
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $namaBulan = $bulanIndonesia[intval($bulan)];

        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)
            ->where('siswa_id', $siswa->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        return view('dashboard.pages.admin.presensi.rekap-presensi-detail', compact('sekolah', 'presensi', 'namaAdmin', 'bulan', 'tahun', 'siswa',  'bulanIndonesia', 'namaBulan'));
    }

    public function rekapPresensiDetailGuru(Siswa $siswa, $bulan, $tahun)
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;
        $namaGuru = $guru->name;

        // Set nilai default untuk bulan dan tahun jika tidak disediakan dalam URL
        $bulan = $bulan ?? date('m');
        $tahun = $tahun ?? date('Y');

        $bulan = max(1, min(12, $bulan));
        // dd($bulan);
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $namaBulan = $bulanIndonesia[intval($bulan)];

        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)
            ->where('siswa_id', $siswa->id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        return view('dashboard.pages.guru.presensi.rekap-presensi-detail', compact('sekolah', 'presensi', 'namaGuru', 'bulan', 'tahun', 'siswa',  'bulanIndonesia', 'namaBulan', 'guru'));
    }

    public function scanKartu()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;
            $namaAdmin = $admin->name;

            // Ambil data status
            $status = Status::first();
            $mode_absen = $status->mode;
            $jam_masuk = '08:00:00';
            $jam_keluar = '16:30:00';

            // Mode absen
            $mode = "";
            if ($mode_absen == 1) {
                $mode = "Masuk";
            } else if ($mode_absen == 2) {
                $mode = "Sholat";
            } else if ($mode_absen == 3) {
                $mode = "Keluar";
            }

            // baca temporary rfid
            $temporaryRfid = TemporaryRfid::first();
            // dd($temporaryRfid);
            if ($temporaryRfid) {
                $no_kartu = $temporaryRfid->no_kartu;
            } else {
                $no_kartu = "";
            }

            return view('dashboard.pages.admin.presensi.scan', compact(
                'sekolah',
                'mode',
                'namaAdmin',
            ));
        } elseif (Auth::guard('web')->check() == true) {
            $guru = Auth::guard('web')->user();
            $sekolah = $guru->sekolah;

            return view('dashboard.pages.guru.presensi.scan', compact('sekolah'));
        }
    }

    public function bacaKartu()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        $status = Status::first();
        $mode_absen = $status->mode;

        $mode = "Sholat";


        $temporaryRfid = TemporaryRfid::first();
        // dd($temporaryRfid);
        if ($temporaryRfid) {
            $no_kartu = $temporaryRfid->no_kartu;
        } else {
            $no_kartu = "";
        }


        return view('dashboard.pages.admin.presensi.baca-kartu', compact('mode_absen', 'mode', 'no_kartu', 'sekolah', 'namaAdmin'));
    }

    public function noKartu()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        // Ambil data dari tabel temporary_rfid
        $temporaryRfid = TemporaryRfid::first(); // Mengambil hanya satu baris data pertama

        // Tampilkan no_kartu
        if ($temporaryRfid) {
            $nokartu = $temporaryRfid->no_kartu;
        } else {
            $nokartu = 'Tempelkan Kartu';
        }


        return view('dashboard.pages.admin.siswa.no_kartu', compact('sekolah', 'nokartu'));
    }

    public function destroy(Request $request, PresensiSholat $presensiSholat)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        dd($presensiSholat->sekolah_id, $sekolah->id);

        // Validasi no_kartu
        $request->validate([
            'no_kartu' => 'required',
        ]);

        // Periksa apakah presensiSholat sesuai dengan sekolah admin
        if ($presensiSholat->sekolah_id != $sekolah->id) {
            return redirect()->route('presensi.index')->with('error', 'Anda tidak memiliki akses untuk menghapus presensi siswa ini');
        }

        // Ambil nilai dari request yang telah divalidasi
        $no_kartu = $request->input('no_kartu');

        // Periksa apakah no_kartu cocok
        if ($no_kartu != $presensiSholat->no_kartu) {
            return redirect()->route('presensi.index')->with('error', 'Gagal menghapus presensi siswa. ID Kartu siswa tidak cocok dengan data siswa yang akan dihapus');
        } elseif (empty($no_kartu)) {
            return redirect()->route('presensi.index')->with('error', 'Gagal menghapus presensi siswa. Lengkapi ID Kartu siswa terlebih dahulu');
        } else {
            $presensiSholat->delete();
            return redirect()->route('presensi.index')->with('delete', 'Presensi siswa berhasil dihapus');
        }
    }
}
