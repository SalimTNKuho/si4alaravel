<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Materi;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = ['mahasiswa_id', 'materi_id', 'nilai'];

    public function student()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function subject()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
