<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    use HasFactory;

    protected $table = 'stok_keluar';

    protected $fillable = [
        'spesies_id',
        'nama_pemohon',
        'nik',
        'jumlah_keluar',
        'tanggal_keluar',
        'sumber_dana',
        'keterangan',
    ];
    public function spesies()
    {
        return $this->belongsTo(Spesies::class, 'spesies_id');
    }
}
