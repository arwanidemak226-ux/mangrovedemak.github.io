<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenanaman extends Model
{
     use HasFactory;

    protected $table = 'lokasi_penanaman'; // Menentukan nama tabel

    protected $fillable = [
        'nama_lokasi',
        'kecamatan',
        'desa',
        'latitude',
        'longitude',
        'tanggal_penanaman',
        'deskripsi',
        'gambar',
    
    ];
    protected $casts = [
        'gambar' => 'array',
        'tanggal_penanaman' => 'date', // Mengubah tipe data tanggal
    ];
}
