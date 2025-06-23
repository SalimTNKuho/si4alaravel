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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->date('tahun_akademik');
            $table->enum('kode_smt', ['Ganjil', 'Genap']);
            $table->String('kelas', 10);
            $table->foreignId('mata_kuliah_id')->constrained('mata__kuliah')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('sesi_id')->constrained('sesi')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
