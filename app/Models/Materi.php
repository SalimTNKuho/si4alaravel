<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['judul', 'konten', 'materi_id', 'author_id']; // Added 'author_id'

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
}
