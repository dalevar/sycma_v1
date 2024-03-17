<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Status;
use App\Models\Jurusan;
use App\Models\JadwalSholat;
use Illuminate\Http\Request;
use App\Models\TemporaryRfid;
use App\Models\PresensiSholat;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;

            $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->get();

            $kelas = Kelas::where('sekolah_id', $sekolah->id)->get();
            if ($kelas->isEmpty()) {
                $kelas = "Isi data kelas terlebih dahulu";
            }

            $jurusan = Jurusan::where('sekolah_id', $sekolah->id)->get();
            if ($jurusan->isEmpty()) {
                $jurusan = "Isi data jurusan terlebih dahulu";
            }

            return view('dashboard.pages.admin.presensi.presensi', compact('sekolah', 'presensi', 'kelas', 'jurusan'));
        } elseif (Auth::guard('web')->check() == true) {
            $guru = Auth::guard('web')->user();
            $sekolah = $guru->sekolah;

            return view('dashboard.pages.guru.presensi.presensi', compact('sekolah'));
        }
    }

    public function rekapPresensi()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;

            $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->get();

            return view('dashboard.pages.admin.presensi.rekap-presensi', compact('sekolah', 'presensi'));
        } elseif (Auth::guard('web')->check() == true) {
            $guru = Auth::guard('web')->user();
            $sekolah = $guru->sekolah;

            return view('dashboard.pages.guru.presensi.rekap-presensi', compact('sekolah'));
        }
    }

    public function scanKartu()
    {
        if (Auth::guard('admin')->check() == true) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;

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


        return view('dashboard.pages.admin.presensi.baca-kartu', compact('mode_absen', 'mode', 'no_kartu', 'sekolah'));
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
}
