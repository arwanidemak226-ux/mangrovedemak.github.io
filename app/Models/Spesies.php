<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesies extends Model
{
     use HasFactory;

    protected $fillable = [
        'nama_spesies',
        'nama_lokal',
        'deskripsi',
        'status_konservasi',
        'gambar',
    ];

    protected $casts = [
        'gambar' => 'array',
    ];    
}
