<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;
            $namaAdmin = $admin->name;

            $guru = Guru::where('sekolah_id', $sekolah->id)->paginate(15);
            $totalGuru = Guru::where('sekolah_id', $sekolah->id)->count();
            $totalGuruLaki = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'L')->count();
            $totalGuruPerempuan = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'P')->count();

            return view('dashboard.pages.admin.guru.guru', compact('sekolah', 'guru', 'totalGuru', 'totalGuruLaki', 'totalGuruPerempuan', 'namaAdmin'));
        } elseif (Auth::guard('web')->check() == true) {
            $guru = Auth::guard('web')->user();
            $sekolah = $guru->sekolah;

            $guru = Guru::where('sekolah_id', $sekolah->id)->paginate(15);
            $totalGuru = Guru::where('sekolah_id', $sekolah->id)->count();
            $totalGuruLaki = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'L')->count();
            $totalGuruPerempuan = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'P')->count();

            return view('dashboard.pages.guru.master_data.guru', compact('sekolah', 'guru', 'totalGuru', 'totalGuruLaki', 'totalGuruPerempuan'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'sekolah_id' => 'required|integer',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        if (Guru::where('email', $request->email)->exists()) {
            return redirect()->route('guru.index')->with('error', 'Gagal menambahkan guru, email sudah terdaftar');
        } elseif (Guru::where('nip', $request->nip)->exists()) {
            return redirect()->route('guru.index')->with('error', 'Gagal menambahkan guru, NIP sudah terdaftar');
        } else {
            Guru::create([
                'nama_lengkap' => $request->nama_lengkap,
                'sekolah_id' => $request->sekolah_id,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'nip' => $request->nip,
            ]);
        }


        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'sekolah_id' => 'required|integer',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        $guru->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'sekolah_id' => $request->input('sekolah_id'),
            'email' => $request->input('email'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('no_hp'),
            'nip' => $request->input('nip'),
        ]);

        return redirect()->route('guru.index')->with('update', 'Guru berhasil diperbarui');
    }

    public function destroy(Request $request, Guru $guru)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
        ]);

        if ($request->nama_lengkap != $guru->nama_lengkap) {
            return redirect()->route('guru.index')->with('error', ' Gagal menghapus guru Nama guru tidak cocok dengan data guru yang akan dihapus');
        } elseif ($request->nama_lengkap == null || $request->nama_lengkap == '') {
            return redirect()->route('guru.index')->with('error', ' Gagal menghapus guru Lengkapi nama guru terlebih dahulu');
        } else {
            $guru->delete();
            return redirect()->route('guru.index')->with('delete', ' Guru berhasil dihapus');
        }
    }

    public function searchGuru(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search = $request->input('search');

        $guru = Guru::where('nama_lengkap', 'like', "%" . $search . "%")
            ->orWhere('email', 'like', "%" . $search . "%")
            ->orWhere('nip', 'like', "%" . $search . "%")
            ->paginate();

        $totalGuru = Guru::where('sekolah_id', $sekolah->id)->count();
        $totalGuruLaki = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'L')->count();
        $totalGuruPerempuan = Guru::where('sekolah_id', $sekolah->id)->where('jenis_kelamin', 'P')->count();

        return view('dashboard.pages.admin.guru.guru', compact('guru', 'search', 'sekolah', 'totalGuru', 'totalGuruLaki', 'totalGuruPerempuan'))->with('search', $search);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_guru', $nama_file);

        Excel::import(new GuruImport, public_path('/file_guru/' . $nama_file));

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diimport');
    }
}
