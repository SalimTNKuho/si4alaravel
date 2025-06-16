<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_materi');
            $table->string('jadwal_materi');
            $table->string('dosen');
            $table->string('kelas');
            $table->string('ruang');
            $table->foreignId('prodi_id')->constrained('prodi')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('fakultas_id')->constrained('fakultas')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
