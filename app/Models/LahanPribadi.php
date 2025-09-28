<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanPribadi extends Model
{
    use HasFactory;

    protected $table = 'lahan_pribadi';

    protected $fillable = [
        'nama_pemilik',
        'alamat',
        'luas_ha',
        'status_lahan',
        'kecamatan',
        'desa',
        'keterangan',
    ];
}
