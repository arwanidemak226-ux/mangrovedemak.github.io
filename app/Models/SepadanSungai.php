<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepadanSungai extends Model
{
    
    use HasFactory;

    protected $table = 'sepadan_sungai';

    protected $fillable = [
        'nama_sungai',
        'titik_koordinat',
        'luas_m2',
        'kecamatan',
        'desa',
        'status_kondisi',
        'keterangan',
    ];
}
