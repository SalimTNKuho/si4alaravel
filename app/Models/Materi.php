<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi'; // Specify the table name
    
    protected $fillable = ['judul', 'nama_materi', 'konten']; // Restrict fillable fields
}
