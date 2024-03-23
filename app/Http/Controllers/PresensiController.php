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

    public function rekapPresensi()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        $bulan = date('m');
        $tahun = date('Y');

        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->get();
        $siswa = Siswa::where('sekolah_id', $sekolah->id)->get();



        return view('dashboard.pages.admin.presensi.rekap-presensi', compact('sekolah', 'presensi', 'namaAdmin', 'bulan', 'tahun', 'siswa'));
    }

    public function rekapPresensiGuru()
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;
        $namaGuru = $guru->name;

        $bulan = date('m');
        $tahun = date('Y');

        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->get();
        $siswa = Siswa::where('sekolah_id', $sekolah->id)->get();

        return view('dashboard.pages.guru.presensi.rekap-presensi', compact('sekolah', 'presensi', 'namaGuru', 'bulan', 'tahun', 'siswa', 'guru'));
    }


    public function rekapPresensiDetail(Siswa $siswa)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        $bulan = date('m');
        $tahun = date('Y');

        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->where('siswa_id', $siswa->id)->get();


        return view('dashboard.pages.admin.presensi.rekap-presensi-detail', compact('sekolah', 'presensi', 'namaAdmin', 'bulan', 'tahun', 'siswa'));
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
