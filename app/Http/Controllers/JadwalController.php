<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index($kelas)
    {
        $jadwal = Jadwal::where('kelas', $kelas)->orderBy('hari')->get();
        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kelas' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'mapel' => 'required|string',
            'guru' => 'required|string',
        ]);

        $jadwal = Jadwal::create($data);

        return response()->json($jadwal, 201);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $data = $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'mapel' => 'required|string',
            'guru' => 'required|string',
        ]);

        $jadwal->update($data);

        return response()->json($jadwal);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json(['message' => 'Jadwal dihapus']);
    }
}
