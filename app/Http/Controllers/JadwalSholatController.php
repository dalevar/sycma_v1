<?php

namespace App\Http\Controllers;

use App\Models\JadwalSholat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JadwalSholatController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $jadwalSholat = \App\Models\JadwalSholat::all();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        return view('dashboard.pages.admin.konfigurasi.jadwal-sholat.jadwalSholat', compact('jadwalSholat', 'sekolah', 'namaAdmin'));
    }

    public function update(Request $request, JadwalSholat $jadwalSholat)
    {
        $request->validate([
            'subuh' => 'required|string|max:255',
            'dzuhur' => 'required|string|max:255',
            'ashar' => 'required|string|max:255',
            'maghrib' => 'required|string|max:255',
            'isya' => 'required|string|max:255',
        ]);

        $jadwalSholat->update([
            'subuh' => $request->input('subuh'),
            'dzuhur' => $request->input('dzuhur'),
            'ashar' => $request->input('ashar'),
            'maghrib' => $request->input('maghrib'),
            'isya' => $request->input('isya'),
        ]);

        return redirect()->route('jadwal-sholat.index')->with('update', 'Jadwal Sholat berhasil diperbarui');
    }

    public function hapusJadwalSholat()
    {
        return view('dashboard.pages.hapus-jadwal-sholat');
    }
}
