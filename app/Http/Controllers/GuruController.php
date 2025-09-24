<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Tampilkan form login guru
     */
    public function showLoginForm()
    {
        return view('guru.login');
    }

    /**
     * Proses login guru
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'sekolah'  => 'required|string',
            'kode'     => 'required|string',
        ]);

        // Cari guru di database
        $guru = Guru::where('username', $request->username)
                    ->where('sekolah', $request->sekolah)
                    ->where('kode', $request->kode)
                    ->first();

        if ($guru) {
            // Simpan data ke session
            session(['guru' => $guru]);

            return redirect()->route('guru.dashboard')
                             ->with('success', 'Berhasil login sebagai guru');
        }

        // Jika gagal
        return back()->withErrors(['login' => 'Username / sekolah / kode salah!']);
    }

    /**
     * Halaman dashboard guru
     */
    public function dashboard()
    {
        if (!session()->has('guru')) {
            return redirect()->route('guru.login')
                             ->withErrors(['login' => 'Silakan login dulu!']);
        }

        return view('guru.dashboard', [
            'guru' => session('guru')
        ]);
    }

    /**
     * Proses logout guru
     */
    public function logout()
    {
        session()->forget('guru');
        return redirect()->route('guru.login')
                         ->with('success', 'Berhasil logout');
    }
}
