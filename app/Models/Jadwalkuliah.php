<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwalkuliah extends Model
{
    protected $table = 'jadwalkuliah'; // nama tabel

    protected $fillable = ['tahun_akademik', 'kode_smt', 'kelas', 'matakuliah_id', 'dosen_id', 'sesi_id'];

    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id', 'id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'id');
    }
}
