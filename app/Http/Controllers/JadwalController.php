<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    // Ambil jadwal berdasarkan kelas
    public function index($kelas)
    {
        if (strtolower($kelas) === strtolower("Semua Angkatan")) {
            // kalau admin mau lihat semua jadwal massal
            $data = Jadwal::where('is_massal', true)->get();
        } else {
            // query lebih fleksibel (abaikan huruf besar kecil & spasi ekstra)
            $kelas = trim(strtolower($kelas));
            $data = Jadwal::whereRaw('LOWER(TRIM(kelas)) = ?', [$kelas])
                          ->orderBy('hari')
                          ->orderBy('jam_mulai')
                          ->get();
        }

        return response()->json($data);
    }

    // Tambah jadwal baru
    public function store(Request $request)
    {
        // Jika pilih "Semua Angkatan", otomatis buat untuk tiap kelas
        if ($request->kelas === "Semua Angkatan") {
            $angkatan = [
                "X PPLG 1","X PPLG 2","X TJKT","X MPLB","X AKL",
                "XI RPL 1","XI RPL 2","XI TKJ","XI MP","XI AK",
                "XII RPL 1","XII RPL 2","XII TKJ","XII MP","XII AK"
            ];

            $data = [];
            foreach ($angkatan as $kls) {
                $data[] = Jadwal::create([
                    'kelas'       => $kls,
                    'hari'        => $request->hari,
                    'jam_mulai'   => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'mapel'       => $request->mapel,
                    'guru'        => $request->guru ?? null,
                    'is_massal'   => true
                ]);
            }
            return response()->json($data);
        }

        // Kalau hanya satu kelas
        $jadwal = Jadwal::create([
            'kelas'       => $request->kelas,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'mapel'       => $request->mapel,
            'guru'        => $request->guru ?? null,
            'is_massal'   => false,
        ]);

        return response()->json($jadwal);
    }

    // Update jadwal
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($request->aksi === "massal") {
            // Update semua kelas dengan mapel + jam yang sama
            Jadwal::where('hari', $jadwal->hari)
                  ->where('jam_mulai', $jadwal->jam_mulai)
                  ->where('jam_selesai', $jadwal->jam_selesai)
                  ->update([
                      'mapel' => $request->mapel,
                      'guru'  => $request->guru ?? null
                  ]);

            return response()->json(['message' => 'Update massal berhasil']);
        }

        // Update hanya satu jadwal
        $jadwal->update([
            'kelas'       => $request->kelas ?? $jadwal->kelas,
            'hari'        => $request->hari ?? $jadwal->hari,
            'jam_mulai'   => $request->jam_mulai ?? $jadwal->jam_mulai,
            'jam_selesai' => $request->jam_selesai ?? $jadwal->jam_selesai,
            'mapel'       => $request->mapel ?? $jadwal->mapel,
            'guru'        => $request->guru ?? $jadwal->guru,
        ]);

        return response()->json($jadwal);
    }

    // Hapus jadwal
    public function destroy(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($request->aksi === "massal") {
            Jadwal::where('hari', $jadwal->hari)
                  ->where('jam_mulai', $jadwal->jam_mulai)
                  ->where('jam_selesai', $jadwal->jam_selesai)
                  ->where('mapel', $jadwal->mapel)
                  ->delete();

            return response()->json(['message' => 'Hapus massal berhasil']);
        }

        $jadwal->delete();
        return response()->json(['message' => 'Hapus berhasil']);
    }
}
