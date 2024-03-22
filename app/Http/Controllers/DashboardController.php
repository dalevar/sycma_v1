<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\PresensiSholat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardAdmin(\App\Charts\PresensiChart $chart)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        $totalDataSiswa = $sekolah->siswa->count();
        $totalSiswaLaki = $sekolah->siswa->where('jenis_kelamin', 'L')->count();
        $totalSiswaPerempuan = $sekolah->siswa->where('jenis_kelamin', 'P')->count();
        $totalJurusan = $sekolah->jurusan->count();
        $totalKelas = $sekolah->kelas->count();

        $tanggal = date('Y-m-d');
        $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->where('tanggal', $tanggal)->get();

        $kelas = $sekolah->kelas;
        $jurusan = $sekolah->jurusan;

        $totalDataSiswa = $sekolah->siswa->count();
        $totalSiswaLaki = $sekolah->siswa->where('jenis_kelamin', 'L')->count();
        $totalSiswaPerempuan = $sekolah->siswa->where('jenis_kelamin', 'P')->count();

        $chart = $chart->build();

        return view('dashboard.pages.admin.dashboard_main.dashboard', compact('admin', 'sekolah', 'totalDataSiswa', 'totalSiswaLaki', 'totalSiswaPerempuan', 'totalJurusan', 'totalKelas', 'presensi', 'kelas', 'jurusan', 'chart'));
    }

    public function dashboardGuru()
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;
        return view('dashboard.pages.guru.dashboard_main.dashboard', compact('sekolah'));
    }
}
