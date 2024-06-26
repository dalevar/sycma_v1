<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Sekolah;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Models\PresensiSholat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardAdmin(\App\Charts\PresensiChart $chart)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;
        $product = $admin->product;

        // Check di payments apakah statusnya sudah success atau masih pending
        $paymentStatus = Payment::where('user_id', $admin->id)->where('status', 'success')->first();
        $status = null;
        if ($paymentStatus) {
            $status = $paymentStatus->status;
        }

        $is_active = $admin->is_active;
        if ($status === 'success' && $is_active == 0) {
            $admin->update([
                'is_active' => 1
            ]);
        }

        $displayStyle = ($is_active == 0) ? 'block' : 'none';


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
        return view('dashboard.pages.admin.dashboard_main.dashboard', compact('admin', 'sekolah', 'totalDataSiswa', 'totalSiswaLaki', 'totalSiswaPerempuan', 'totalJurusan', 'totalKelas', 'presensi', 'kelas', 'jurusan', 'chart', 'namaAdmin', 'is_active', 'displayStyle', 'product'));
    }

    public function dashboardGuru(\App\Charts\PresensiChart $chart)
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;


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

        return view('dashboard.pages.guru.dashboard_main.dashboard', compact('sekolah', 'guru', 'totalDataSiswa', 'totalSiswaLaki', 'totalSiswaPerempuan', 'totalJurusan', 'totalKelas', 'presensi', 'kelas', 'jurusan', 'chart'));
    }

    public function profileAdmin()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;
        $productAdmin = $admin->product;

        $status = Payment::where('user_id', $admin->id)->where('status', 'success')->first();
        if ($status) {
            $status = $status->status;
        } else {
            $status = 'pending';
        }

        return view('dashboard.pages.admin.profile.profile', compact('admin', 'sekolah', 'namaAdmin', 'sekolah', 'productAdmin', 'status',));
    }

    public function updateProfileAdmin(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        $request->validate([
            'sekolah_id' => 'required',
            'name' => 'required|min:5',
            'email' => 'required|email',
            'product_id' => 'required',
        ]);

        if ($request->all() == null) {
            return redirect()->back()->with('error', 'Data tidak boleh kosong');
        } elseif ($request->name == $admin->name && $request->email == $admin->email) {
            return redirect()->back()->with('error', 'Data tidak ada yang berubah');
        }

        $admin->update([
            'sekolah_id' => $request->sekolah_id,
            'name' => $request->name,
            'email' => $request->email,
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diupdate');
    }

    public function destroyProfileAdmin(Request $request, \App\Models\User $user)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required',
        ]);

        if ($request->name == $admin->name) {
            $admin->delete();
            return redirect()->route('logout');
        } elseif ($request->name == null) {
            return redirect()->back()->with('error', 'Nama tidak boleh kosong');
        } else {
            return redirect()->back()->with('error', 'Nama tidak cocok');
        }
    }

    public function profileGuru()
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;

        return view('dashboard.pages.guru.profile.profile', compact('guru', 'sekolah'));
    }

    public function updateProfileGuru(Request $request)
    {
        $guru = Auth::guard('web')->user();
        $sekolah = $guru->sekolah;

        $request->validate([
            'sekolah_id' => 'required',
            'nama_lengkap' => 'required|min:5',
            'email' => 'required|email',
        ]);
        // dd($request->all());

        if ($request->all() == null) {
            return redirect()->back()->with('error', 'Data tidak boleh kosong');
        } elseif ($request->nama_lengkap == $guru->nama_lengkap && $request->email == $guru->email) {
            return redirect()->back()->with('error', 'Data tidak ada yang berubah');
        }

        $guru->update([
            'sekolah_id' => $request->sekolah_id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diupdate');
    }

    public function destroyProfileGuru(Request $request, \App\Models\Guru $guru)
    {
        $guru = Auth::guard('web')->user();
        $request->validate([
            'nama_lengkap' => 'required',
        ]);

        if ($request->nama_lengkap == $guru->nama_lengkap) {
            $guru->delete();
            return redirect()->route('logout');
        } elseif ($request->nama_lengkap == null) {
            return redirect()->back()->with('error', 'Nama tidak boleh kosong');
        } else {
            return redirect()->back()->with('error', 'Nama tidak cocok');
        }
    }
}
