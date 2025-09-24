<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    // Kalau nama tabel kamu "guru" (bukan default "gurus")
    protected $table = 'guru';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'username',
        'sekolah',
        'kode',
    ];

    // Kalau tidak mau pakai timestamps (created_at & updated_at)
    public $timestamps = true;
}
