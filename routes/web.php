<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\GuruController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route halaman aplikasi
|
*/

// Halaman utama
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/index', function () {
    return view('index');
});

// Halaman pilih login
Route::get('/pilih', function () {
    return view('pilih');
})->name('pilih');

/*
|--------------------------------------------------------------------------
| Login Siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->group(function () {
    Route::get('/register', [SiswaAuthController::class, 'showRegister'])->name('siswa.register');
    Route::post('/register', [SiswaAuthController::class, 'register'])->name('siswa.register.submit');

    Route::get('/login', [SiswaAuthController::class, 'showLogin'])->name('siswa.login');
    Route::post('/login', [SiswaAuthController::class, 'login'])->name('siswa.login.submit');

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaAuthController::class, 'dashboard'])->name('siswa.dashboard');
        Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');
    });
});


/*
|--------------------------------------------------------------------------
| Login Guru
|--------------------------------------------------------------------------
*/
Route::get('/register-guru', [GuruController::class, 'showRegisterForm'])->name('guru.register');
Route::post('/register-guru', [GuruController::class, 'register'])->name('guru.register.submit');
Route::get('/guru/login', [GuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/guru/login', [GuruController::class, 'login'])->name('guru.login.submit');
Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
Route::post('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

