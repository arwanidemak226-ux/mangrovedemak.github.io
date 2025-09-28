<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanahDesa extends Model
{
    use HasFactory;

    protected $table = 'tanah_desa'; // pastikan sesuai migration

    protected $fillable = [
        'nama_lahan',
        'alamat',
        'luas_ha',
        'status_kepemilikan',
        'kecamatan',
        'desa',
        'keterangan',
    ];
}
