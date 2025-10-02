<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

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
            'nip'      => 'required|string|max:100|unique:guru,nip',
        ]);

        Guru::create([
            'username' => $request->username,
            'sekolah'  => $request->sekolah,
            'nip'      => $request->nip,
        ]);

        return redirect()->route('guru.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showLoginForm()
    {
        return view('guru.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'sekolah'  => 'required|string',
            'nip'      => 'required|string',
        ]);

        // Cari guru berdasarkan username, sekolah, dan nip
        $guru = Guru::where('username', $request->username)
                    ->where('sekolah', $request->sekolah)
                    ->where('nip', $request->nip)
                    ->first();

        if (!$guru) {
            return back()->withErrors(['login' => 'Username, sekolah, atau NIP salah!'])
                         ->withInput($request->only('username','sekolah','nip'));
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