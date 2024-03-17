<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Status;
use App\Models\JadwalSholat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class authController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function adminLogin()
    {
        return view('auth.login-admin');
    }

    public function loginAdminProses(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $modePresensi = Status::first();
            if ($modePresensi == null) {
                Status::create([
                    'mode' => 1
                ]);
            }


            // Ambil semua data jadwal sholat dari database
            $dataSholatDatabase = JadwalSholat::all();

            // Fetch jadwal sholat dari API
            $tahunSekarang = date('Y');
            $bulanSekarang = date('m');
            $response = Http::get('https://raw.githubusercontent.com/lakuapik/jadwalsholatorg/master/adzan/banjarmasin/' . $tahunSekarang . '/' . $bulanSekarang . '.json');
            $jadwalSholatAPI = $response->json();

            // Jika data jadwal sholat bulan ini sudah ada di database
            if ($dataSholatDatabase->isEmpty()) {
                // Jika data kosong, tambahkan semua data dari API ke database
                foreach ($jadwalSholatAPI as $jadwalAPI) {
                    JadwalSholat::create([
                        'tanggal' => $jadwalAPI['tanggal'],
                        'jenis_sholat' => 'Dzuhur',
                        'waktu_sholat' => $jadwalAPI['dzuhur']
                    ]);
                }

                Session::flash('info', 'Data Jadwal sholat bulan ini telah masuk');
            } else {
                // Jika data sudah ada, periksa tahun dan bulan
                $tahunData = $dataSholatDatabase->pluck('tanggal')->map(function ($item) {
                    return Carbon::parse($item)->year;
                })->unique();
                $bulanData = $dataSholatDatabase->pluck('tanggal')->map(function ($item) {
                    return Carbon::parse($item)->month;
                })->unique();

                if (!$tahunData->contains($tahunSekarang) || !$bulanData->contains($bulanSekarang)) {
                    // Jika tahun atau bulan berbeda, tambahkan data dari API
                    foreach ($jadwalSholatAPI as $jadwalAPI) {
                        JadwalSholat::updateOrCreate(
                            ['tanggal' => $jadwalAPI['tanggal'], 'jenis_sholat' => 'Dzuhur'],
                            ['waktu_sholat' => $jadwalAPI['dzuhur']]
                        );
                    }
                    Session::flash('info', 'Data Jadwal sholat bulan ini telah diupdate');
                }
            }
            return redirect()->intended('dashboard');
        }

        // Authentication failed
        if (User::where('email', $credentials['email'])->exists()) {
            // Email exists, password is incorrect
            return back()->withErrors(['password' => 'Password Salah']);
        } else {
            // Email is not registered
            return back()->withErrors(['email' => 'Email Tidak Terdaftar']);
        }

        // Handle login failure
        return redirect()->back()->withErrors(['loginError' => 'Login failed.']);
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Anda telah berhasil logout');
        return redirect('/login');
    }
}
