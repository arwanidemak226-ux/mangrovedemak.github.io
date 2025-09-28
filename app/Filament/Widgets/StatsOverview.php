<?php

namespace App\Filament\Widgets;

use App\Models\LokasiPenanaman;
use App\Models\PendataanTanaman;
use App\Models\Spesies;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalTanaman = DB::table('pendataan_tanaman')->sum('jumlah_tanaman');
        $totalSpesies = Spesies::count();
        $totalLokasi = LokasiPenanaman::count();

        return [
            Card::make('Total Tanaman', $totalTanaman)
                ->description('Jumlah keseluruhan tanaman yang didata')
                ->color('success'),
            Card::make('Total Spesies', $totalSpesies)
                ->description('Jumlah spesies yang unik')
                ->color('info'),
            Card::make('Total Lokasi', $totalLokasi)
                ->description('Jumlah lokasi penanaman yang terdaftar')
                ->color('primary'),
        ];
    }
}