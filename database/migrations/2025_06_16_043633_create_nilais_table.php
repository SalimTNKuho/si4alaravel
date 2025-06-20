<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('keterangan');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('materi_id')->constrained('materi')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
