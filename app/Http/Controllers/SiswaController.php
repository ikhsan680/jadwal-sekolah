<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function login(Request $request)
    {
        // Bebas isi apa aja
        $request->validate([
            'username' => 'required|string',
            'sekolah'  => 'required|string',
            'kelas'    => 'required|string',
        ]);

        session([
            'siswa' => $request->only('username', 'sekolah', 'kelas')
        ]);

        return redirect()->route('siswa.dashboard')
                         ->with('success', 'Login siswa berhasil!');
    }

    public function dashboard()
    {
        if (!session()->has('siswa')) {
            return redirect()->route('siswa.login');
        }
        return view('siswa.dashboard', ['siswa' => session('siswa')]);
    }

    public function logout()
    {
        session()->forget('siswa');
        return redirect()->route('siswa.login');
    }
}