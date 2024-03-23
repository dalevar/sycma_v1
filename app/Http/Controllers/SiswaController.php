<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\TemporaryRfid;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;
            $namaAdmin = $admin->name;

            $siswa = Siswa::where('sekolah_id', $sekolah->id)->get();

            $jurusan = $sekolah->jurusan;
            $kelas = $sekolah->kelas;



            $kelasArray = [];
            foreach ($kelas as $k) {
                $kelasArray[$k->id] = $k->kelas;
            }

            // Ambil data dari tabel temporary_rfid
            $temporaryRfid = TemporaryRfid::first(); // Mengambil hanya satu baris data pertama

            // Tampilkan no_kartu
            if ($temporaryRfid) {
                $nokartu = $temporaryRfid->no_kartu;
            } else {
                $nokartu = 'Tempelkan Kartu';
            }

            $totalDataSiswa = Siswa::where('sekolah_id', $sekolah->id)->count();
            $totalDataSiswaLaki = Siswa::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'L')->count();
            $totalDataSiswaPerempuan = Siswa::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'P')->count();

            return view('dashboard.pages.admin.siswa.siswa', compact('admin', 'sekolah', 'jurusan', 'kelasArray', 'kelas', 'nokartu', 'siswa', 'totalDataSiswa', 'totalDataSiswaLaki', 'totalDataSiswaPerempuan', 'namaAdmin'));
        } elseif (Auth::guard('web')->check() == true) {
            $guru = Auth::guard('web')->user();
            $sekolah = $guru->sekolah;

            $jurusan = $sekolah->jurusan;
            $kelas = $sekolah->kelas;

            $kelasArray = [];
            foreach ($kelas as $k) {
                $kelasArray[$k->id] = $k->kelas;
            }

            return view('dashboard.pages.guru.master_data.siswa', compact('guru', 'sekolah', 'jurusan', 'kelasArray', 'kelas'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getKelas($id)
    {
        $kelas = Kelas::where('jurusan_id', $id)->get();

        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kartu' => 'required',
            'sekolah_id' => 'required',
            'nama_lengkap' => 'required',
            'kelas_id' => 'required',
            'jurusan_id' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'nis' => 'required'
        ]);
        // dd($request->all());

        $siswa = Siswa::create($request->all());
        if ($siswa) {
            TemporaryRfid::truncate();
        } else {
            return redirect()->route('siswa.index')->with('error', 'Data siswa gagal ditambahkan');
        }

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'no_kartu' => 'required',
            'sekolah_id' => 'required',
            'nama_lengkap' => 'required',
            'kelas_id' => 'required',
            'jurusan_id' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'nis' => 'required'
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('update', 'Data siswa berhasil diubah');
    }

    public function destroy(Request $request, Siswa $siswa)

    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
        ]);

        if ($request->nama_lengkap != $siswa->nama_lengkap) {
            return redirect()->route('siswa.index')->with('error', ' Gagal menghapus siswa Nama siswa tidak cocok dengan data siswa yang akan dihapus');
        } elseif ($request->nama_lengkap == null || $request->nama_lengkap == '') {
            return redirect()->route('siswa.index')->with('error', ' Gagal menghapus siswa Lengkapi nama siswa terlebih dahulu');
        } else {
            $siswa->delete();
            return redirect()->route('siswa.index')->with('delete', ' siswa berhasil dihapus');
        }
    }
}
