<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Spesies;

class StokTanaman extends Model
{
     use HasFactory;

    protected $table = 'stok_tanaman';

    protected $fillable = [
        'spesies_id',
        'jumlah_stok',
        'tanggal_masuk',
        'sumber_dana',
        'keterangan',
    ];
    public function spesies(): BelongsTo
    {
        return $this->belongsTo(Spesies::class, 'spesies_id');
    }
}
