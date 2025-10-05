<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jadwal; // <-- perbaikan huruf besar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    // === TAMPILKAN FORM ===
    public function showRegister()
    {
        return view('siswa.register');
    }

    public function showLogin()
    {
        return view('siswa.login');
    }

    // === PROSES REGISTER ===
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'sekolah'  => 'required|string|max:100',
            'nis'      => 'required|string|max:20|unique:siswa,nis',
            'angkatan' => 'required|string|max:10',
            'kelas'    => 'required|string|max:50',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // === PROSES LOGIN (tanpa password, cukup NIS/username) ===
    public function login(Request $request)
    {
        $request->validate([
            'nis'      => 'required|string',
            'sekolah'  => 'required|string',
            'angkatan' => 'required|string',
            'kelas'    => 'required|string',
        ]);

        $siswa = Siswa::where('nis', $request->nis)
            ->where('sekolah', $request->sekolah)
            ->where('angkatan', $request->angkatan)
            ->where('kelas', $request->kelas)
            ->first();

        if ($siswa) {
            Auth::guard('siswa')->login($siswa);
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['login' => 'Data siswa tidak ditemukan atau salah.']);
    }

    // === DASHBOARD SISWA ===
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();

        // ambil jadwal sesuai kelas siswa
        $jadwal = Jadwal::where('kelas', $siswa->kelas)->get();

        return view('siswa.dashboard', compact('siswa', 'jadwal'));
    }

    // === LOGOUT ===
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login');
    }
}
