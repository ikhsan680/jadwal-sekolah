<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
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
Route::get('/siswa/login', [SiswaController::class, 'showLoginForm'])->name('siswa.login');
Route::post('/siswa/login', [SiswaController::class, 'login'])->name('siswa.login.submit');
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::post('/siswa/logout', [SiswaController::class, 'logout'])->name('siswa.logout');

/*
|--------------------------------------------------------------------------
| Login Guru
|--------------------------------------------------------------------------
*/
Route::get('/guru/login', [GuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/guru/login', [GuruController::class, 'login'])->name('guru.login.submit');
Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
Route::post('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');
