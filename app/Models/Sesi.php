<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $fillable = ['nama']; // nama tabel
    protected $table = 'sesi'; // Specify the table name if it differs from the model name
}
