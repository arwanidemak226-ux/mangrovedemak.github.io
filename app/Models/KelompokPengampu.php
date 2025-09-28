<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokPengampu extends Model
{
    use HasFactory;

    protected $table = 'kelompok_pengampu';

    protected $fillable = [
        'nama_kelompok',
        'nama',
        'kontak',
        'deskripsi',
        'jabatan',
        'sk_akta_notaris',
        'sk_kepala_desa',
    ];
}
