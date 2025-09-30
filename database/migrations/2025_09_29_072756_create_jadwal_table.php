<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');       // X PPLG 1, XI RPL 2, dll
            $table->string('hari');        // Senin, Selasa, ...
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('mapel');
            $table->string('guru')->nullable(); // Nama guru, bisa null
            $table->boolean('is_massal')->default(false); // penanda jadwal massal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
