<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_materi', 'deskripsi', 'materi_id', 'author_id']; // Updated 'fillable'

    protected $table = 'materi'; // Specify the table name if it differs from the model name
    // public $timestamps = true; // Enable timestamps

    // Define a relationship to the User model
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    // Relasi ke Nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
