<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    public function index()
    {
        // $jurusan = Jurusan::paginate(10);
        $admin = Auth::guard('admin')->user(); // Mengambil admin yang sedang login
        // dd($admin);
        $sekolah = $admin->sekolah;
        $jurusan = Jurusan::where('sekolah_id', $sekolah->id)->get();

        return view('dashboard.pages.admin.konfigurasi.jurusan.jurusan', compact('jurusan', 'sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
            'sekolah_id' => 'required|integer',
        ]);

        Jurusan::create([
            'jurusan' => $request->jurusan,
            'sekolah_id' => $request->sekolah_id,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }


    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);

        $jurusan->update([
            'jurusan' => $request->input('jurusan'),
        ]);

        return redirect()->route('jurusan.index')->with('update', 'Jurusan berhasil diperbarui');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('delete', 'Jurusan berhasil dihapus');
    }
}
