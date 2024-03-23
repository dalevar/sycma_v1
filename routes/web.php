<?php

use App\Livewire\WizardValidation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\auth\authController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSholatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage.index');
});

Route::get('/harga', function () {
    return view('landingpage.pages.harga');
});

Route::get('/product-select', [WizardValidation::class, 'getPaket'])->name('product-select');

// Authentication Route
// Registration
Route::get('/register', [\App\Http\Controllers\auth\authController::class, 'register'])->name('register');

// Login Admin Proses
Route::get('/login-admin', [\App\Http\Controllers\auth\authController::class, 'adminLogin'])->name('login-admin');
Route::post('/login-admin-proses', [\App\Http\Controllers\auth\authController::class, 'loginAdminProses'])->name('login-admin-proses');

// Login Guru Proses
Route::get('/login', [\App\Http\Controllers\auth\authController::class, 'login'])->name('login');
Route::get('/login-proses', [\App\Http\Controllers\auth\authController::class, 'loginProses'])->name('login-proses');

// Logout
Route::get('/logout', [\App\Http\Controllers\auth\authController::class, 'logout'])->name('logout');

// DASHBOARD BACKOFFICE ADMIN
Route::get('/backoffice-sycma/dashboard', [\App\Http\Controllers\backofficeController::class, 'index'])->name('backoffice');
// Authentication Bacoffice
Route::get('/backoffice-sycma/register', [\App\Http\Controllers\backofficeController::class, 'backofficeRegister'])->name('backoffice-register');
Route::post('/backoffice-sycma/register-proses', [\App\Http\Controllers\auth\authController::class, 'backofficeRegisterProses'])->name('backoffice-register-proses');
Route::get('/backoffice-sycma/login', [\App\Http\Controllers\backofficeController::class, 'backofficeLogin'])->name('backoffice-login');
Route::post('/backoffice-sycma/login-proses', [\App\Http\Controllers\auth\authController::class, 'backofficeLoginProses'])->name('backoffice-login-proses');
Route::get('/backoffice-sycma/logout', [\App\Http\Controllers\auth\authController::class, 'backofficeLogout'])->name('backoffice-logout');

// Dashboard Route Admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard-admin.index');
});

// Dashboard Route Guru
Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard-guru', [DashboardController::class, 'dashboardGuru'])->name('dashboard-guru.index');
    // Route::get('presensi', [PresensiController::class, 'presensiGuru'])->name('presensi-guru.index');
    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('guru', [GuruController::class, 'index'])->name('guru.index');
});

// Jurusan Route
Route::get('jurusan', [JurusanController::class, 'index'])->name('jurusan.index')->middleware('auth:admin');
Route::post('jurusan', [JurusanController::class, 'store'])->name('jurusan.store')->middleware('auth:admin');
Route::put('jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update')->middleware('auth:admin');
Route::delete('jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy')->middleware('auth:admin');

// Kelas Route
Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index')->middleware('auth:admin');
Route::post('kelas', [KelasController::class, 'store'])->name('kelas.store')->middleware('auth:admin');
Route::put('kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update')->middleware('auth:admin');
Route::delete('kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy')->middleware('auth:admin');

// Jadwal Sholat Route
Route::get('jadwal-sholat', [JadwalSholatController::class, 'index'])->name('jadwalsholat.index')->middleware('auth:admin');
Route::put('jadwal-sholat/{jadwalSholat}', [JadwalSholatController::class, 'update'])->name('jadwalsholat.update')->middleware('auth:admin');

// Guru Route
Route::get('guru', [GuruController::class, 'index'])->name('guru.index');
Route::post('guru', [GuruController::class, 'store'])->name('guru.store');
Route::put('guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
Route::get('guru/search', [GuruController::class, 'searchGuru'])->name('cari-guru');

// Siswa Route
Route::get('/siswa/{id}', [SiswaController::class, 'getKelas'])->name('getKelas');
Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store')->middleware('auth:admin');
Route::put('siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update')->middleware('auth:admin');
Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy')->middleware('auth:admin');

/********** PRESENSI ADMIN ROUTE */
// Presensi Route
Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index')->middleware('auth:admin');
Route::delete('presensi/{presensi}', [PresensiController::class, 'destroy'])->name('presensi.destroy');

// Rekap Presensi
Route::get('rekap-presensi', [PresensiController::class, 'rekapPresensi'])->name('rekap-presensi.index');
// Rekap Presensi Detail Siswa
Route::get('rekap-presensi/{siswa}', [PresensiController::class, 'rekapPresensiDetail'])->name('rekap-presensi-detail.index');

// Scan Kartu
Route::get('scan', [PresensiController::class, 'scanKartu'])->name('scan-kartu.index');
// baca kartu
Route::get('baca-kartu', [PresensiController::class, 'bacaKartu'])->name('baca-kartu.index')->middleware('auth:admin');
// NO KARTU
Route::get('no-kartu', [PresensiController::class, 'noKartu'])->name('no-kartu.index')->middleware('auth:admin');

// Profile Route
Route::get('profile', [DashboardController::class, 'profileAdmin'])->name('profile.index');
Route::put('profile/{admin}', [DashboardController::class, 'updateProfileAdmin'])->name('profile.update');
Route::delete('profile/{admin}', [DashboardController::class, 'destroyProfileAdmin'])->name('profile.destroy');
/********** GURU ROUTE */
// PRESENSI GURU ROUTE
Route::get('presensi-guru', [PresensiController::class, 'presensiGuru'])->name('presensi-guru.index');

// REKAP PRESENSI GURU ROUTE
Route::get('rekap-presensi-guru', [PresensiController::class, 'rekapPresensiGuru'])->name('rekap-presensi-guru.index');

// SISWA GURU ROUTE
Route::get('siswa-guru', [SiswaController::class, 'indexGuru'])->name('siswa-guru.index');
// GURU GURU ROUTE
Route::get('guru-guru', [GuruController::class, 'indexGuru'])->name('guru-guru.index');

// Profile Guru Route
Route::get('profile-guru', [DashboardController::class, 'profileGuru'])->name('profile-guru.index');
Route::put('profile-guru/{guru}', [DashboardController::class, 'updateProfileGuru'])->name('profile-guru.update');
Route::delete('profile-guru/{guru}', [DashboardController::class, 'destroyProfileGuru'])->name('profile-guru.destroy');

/****** BACKOFFICE ADMIN SYCMA ROUTE */
// Tampilkan produk dan kategori
Route::get('backoffice-sycma/produk', [\App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
Route::get('backoffice-sycma/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

// Kategori
Route::post('backoffice-sycma/category', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::put('backoffice-sycma/category/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::delete('backoffice-sycma/category/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');

// Produk
Route::post('backoffice-sycma/produk', [\App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
Route::put('backoffice-sycma/produk/{id}', [\App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
Route::delete('backoffice-sycma/produk/{id}', [\App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');


/****** LIBRARY ROUTE & RFID */
// Oauth Google login Guru
Route::get('/login/google', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'handleGoogleCallback']);

// RFID CARD Route
Route::get('presensi/kirimkartu/{nokartu}', [\App\Http\Controllers\rfid\RfidCard::class, 'kirimKartu'])->name('rfid-card.index');

// Import Route
Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
