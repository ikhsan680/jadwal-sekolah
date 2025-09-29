<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function showRegisterForm()
    {
        return view('guru.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'sekolah'  => 'required|string|max:255',
            'nip'      => 'required|string|max:100|unique:guru,nip', // kalau pakai tabel 'guru'
        ]);

        // Simpan ke DB (table 'guru' sesuai model)
        Guru::create([
            'username' => $request->username,
            'sekolah'  => $request->sekolah,
            'nip'      => $request->nip,
        ]);

        return redirect()->route('guru.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showLoginForm()
    {
        return view('guru.login'); // pastikan view path sesuai
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'sekolah'  => 'required|string',
        'kode'     => 'required|string',
    ]);

    // cari guru di database berdasarkan username + sekolah
    $guru = \App\Models\Guru::where('username', $request->username)
                ->where('sekolah', $request->sekolah)
                ->first();

    if (!$guru) {
        return back()->withErrors(['login' => 'Username atau sekolah tidak terdaftar!'])
                     ->withInput($request->only('username','sekolah'));
    }

    // cek kode global
    $kodeInput = $request->kode;
    $kodeBenar = env('GURU_LOGIN_CODE');

    // opsi: jika pakai hash di .env
    $kodeHash = env('GURU_LOGIN_CODE_HASH');

    $validKode = false;
    if ($kodeBenar && hash_equals($kodeBenar, $kodeInput)) {
        $validKode = true;
    }
    if ($kodeHash && \Illuminate\Support\Facades\Hash::check($kodeInput, $kodeHash)) {
        $validKode = true;
    }

    if (!$validKode) {
        return back()->withErrors(['login' => 'Kode guru salah!'])
                     ->withInput($request->only('username','sekolah'));
    }

    // sukses → simpan guru ke session
    session(['guru' => $guru]);

    return redirect()->route('guru.dashboard')
                     ->with('success','Berhasil login.');
}


    public function dashboard()
    {
        if (!session()->has('guru')) {
            return redirect()->route('guru.login')->withErrors(['login' => 'Silakan login dulu!']);
        }

        return view('guru.dashboard', [
            'guru' => session('guru')
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('guru');
        return redirect()->route('guru.login')->with('success','Anda berhasil logout.');
    }
}
