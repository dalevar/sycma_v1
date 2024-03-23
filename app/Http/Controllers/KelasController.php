<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $namaAdmin = $admin->name;

        $kelas = Kelas::where('sekolah_id', $sekolah->id)->get();
        $jurusan = Jurusan::where('sekolah_id', $sekolah->id)->get();
        // dd($kelas, $jurusan, $sekolah);
        return view('dashboard.pages.admin.konfigurasi.kelas.kelas', compact('kelas', 'jurusan', 'sekolah', 'namaAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'jurusan_id' => 'required|integer',
            'sekolah_id' => 'required|integer',
        ]);

        Kelas::create([
            'kelas' => $request->kelas,
            'jurusan_id' => $request->jurusan_id,
            'sekolah_id' => $request->sekolah_id,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'jurusan_id' => 'required|integer',
        ]);

        $kelas->update([
            'kelas' => $request->input('kelas'),
            'jurusan_id' => $request->input('jurusan_id'),
        ]);

        return redirect()->route('kelas.index')->with('update', 'Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')->with('delete', 'Kelas berhasil dihapus');
    }
}
