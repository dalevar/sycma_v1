<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class SocialiteController extends Controller
{
    /**
     * Redirect ke Google untuk autentikasi.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google setelah autentikasi berhasil.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $guru = Guru::where('email', $user->getEmail())->first();

            if (!$guru) {
                // Jika pengguna tidak ditemukan, maka beri pesan error akun email tidak terdaftar
                Session::flash('error', ' Gagal login. Silahkan hubungi admin!');
                return redirect('/login');
            }

            // Login pengguna
            $request->session()->regenerate();
            Auth::login($guru);

            // Redirect ke halaman dashboard atau halaman yang sesuai
            return redirect('/dashboard-guru');
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return redirect('/login')->withErrors('Terjadi kesalahan saat autentikasi dengan Google.');
        }
    }
}
