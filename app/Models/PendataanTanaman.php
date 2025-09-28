<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\KelompokPengampu; // <-- TAMBAHKAN INI
use App\Models\Anggaran;        // <-- TAMBAHKAN INI

class PendataanTanaman extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pendataan_tanaman';

    protected $fillable = [
        'lokasi_id',
        'spesies_id',
        'tanggal_pendataan',
        'jumlah_tanaman',
        'tinggi_rata_rata',
        'kondisi_tanaman',
        'catatan',
        'dokumentasi',
        'kelompok_pengampu_id',
        'anggaran',
        'luasan',
    ];

    protected $casts = [
        'tanggal_pendataan' => 'date',
        'dokumentasi' => 'array',
        'luasan' => 'decimal:2',
    ];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(LokasiPenanaman::class, 'lokasi_id');
    }

    public function spesies(): BelongsTo
    {
        return $this->belongsTo(Spesies::class, 'spesies_id');
    }

    // Pastikan nama fungsi ini lowercase_snake_case
    public function kelompokpengampu(): BelongsTo{
        return $this->belongsTo(KelompokPengampu::class, 'kelompok_pengampu_id');
    }
}