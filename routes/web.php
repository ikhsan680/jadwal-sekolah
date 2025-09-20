<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
    
});
Route::get('/pilih', function () {
    return view('pilih');
});
route::get('/index', function () {
    return view('index');
});
Route::get('/siswa/login', function () {
    return view('siswa.login');
})->name('siswa.login');
Route::get('/guru/login', function () {
    return view('guru.login');
})->name('guru.login');
