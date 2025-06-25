<?php

namespace App\Models;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa'; // nama tabel (Note: ini harus sama dengan nama tabel di database)

    protected $fillable = ['nama', 'npm', 'jk', 'tanggal_lahir', 'tempat_lahir', 'asal_sma', 'prodi_id', 'foto'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
