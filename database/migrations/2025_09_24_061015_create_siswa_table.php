<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('sekolah', 100);
            $table->string('nis', 20)->unique();
            $table->string('angkatan', 10);  // contoh: X, XI, XII
            $table->string('kelas', 50);     // contoh: XI RPL 1
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('siswa');
    }
};
