<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['judul', 'nama_materi', 'konten']; // Restrict fillable fields

    protected $table = 'materi'; // Specify the table name if it differs from the model name
    // public $timestamps = true; // Enable timestamps
}
