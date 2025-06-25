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
        // membuat tabel mahasiswa utk di migrate
        // migrate dilakukan di terminal dengan perintah 'php artisan migrate'
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->String('npm', 11);
            $table->String('nama', 30);
            $table->enum('jk', ['L', 'P']); // pilihan ganda pakai 'enum' seperti pilihan "jenis kelamin" ini
            $table->date('tanggal_lahir'); // tanggal lahir pakai 'date'
            $table->String('tempat_lahir', 30);
            $table->String('asal_sma', 30);
            $table->ForeignId('prodi_id')->constrained('prodi')->onDelete('restrict')->onUpdate('restrict');
            $table->String('foto', 50)->nullable(); // foto pakai '->nullable()' supaya bisa kosong/tidak wajib
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
