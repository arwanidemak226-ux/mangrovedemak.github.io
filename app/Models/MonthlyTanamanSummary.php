<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTanamanSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'spesies_id',
        'total_tanaman',
        'year',
        'month',
    ];
    public function spesies()
    {
        return $this->belongsTo(Spesies::class);
    }
}
