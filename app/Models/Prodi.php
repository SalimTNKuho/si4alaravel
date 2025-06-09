<?php

namespace App\Models;

use App\Models\Fakultas;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi'; // nama tabel

    protected $fillable = ['nama', 'singkatan', 'kaprodi', 'sekretaris', 'fakultas_id']; // nama tabel (Note: ini harus sama dengan nama tabel di database)
    // protected $guarded = ['id']; // jika ingin menggunakan guarded, hapus $fillable di atas
    // protected $table = 'prodi'; // nama tabel (Note: ini harus sama dengan nama tabel di database)

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }
}
