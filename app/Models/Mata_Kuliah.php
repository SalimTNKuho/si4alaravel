<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mata_Kuliah extends Model
{
    protected $fillable = ['kode_mk', 'nama', 'prodi_id']; // nama tabel

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id'); // relasi ke Prodi
    }
}
