<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersediaanTanaman extends Model
{
    use HasFactory;

    protected $table = 'persediaan_tanaman';

    protected $fillable = [
        'stok_tanaman_id',
        'jumlah_masuk',
        'jumlah_keluar',
        'sisa_stok',
    ];
    public function stokTanaman()
    {
        return $this->belongsTo(StokTanaman::class, 'stok_tanaman_id');
    }
}
