<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen'; // nama tabel
    
    protected $fillable = ['nama', 'nid', 'prodi_id']; // nama tabel

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id'); // relasi ke Mahasiswa
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id'); // relasi ke Prodi
    }
}
