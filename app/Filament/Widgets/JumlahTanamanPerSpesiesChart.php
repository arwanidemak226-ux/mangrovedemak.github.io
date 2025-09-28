<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyTanamanSummary;
use App\Models\PendataanTanaman;
use App\Models\Spesies;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class JumlahTanamanPerSpesiesChart extends ChartWidget
{
    protected static ?string $chartId = 'jumlahTanamanPerSpesiesChart';

    protected static ?string $slug = 'jumlah-tanaman-per-spesies';

    protected static ?string $heading = 'Jumlah Tanaman per Spesies';

    protected static ?string $footer = 'Data berdasarkan total jumlah tanaman per bulan.';

    protected static ?string $pollingInterval = '15s';
    
    protected static ?int $sort = 1;

    protected function getData(): array
    {
         $dataByMonthAndSpecies = PendataanTanaman::with('spesies')
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->tanggal_pendataan)->format('Y-m');
            })
            ->map(function ($items) {
                return $items->groupBy('spesies.nama_spesies');
            });

        $allMonths = $dataByMonthAndSpecies->keys()->sort();
        $allSpesies = Spesies::pluck('nama_spesies');

        $datasets = [];

        foreach ($allSpesies as $spesies) {
            $data = [];
            foreach ($allMonths as $month) {
                $count = $dataByMonthAndSpecies[$month][$spesies] ?? collect();
                $data[] = $count->count();
            }

            // Tambahkan data spesies ke dalam datasets
            $datasets[] = [
                'label' => $spesies,
                'data' => $data,
            ];
        }

        // Ubah format label bulan menjadi nama bulan yang lebih mudah dibaca
        $labels = $allMonths->map(function($month) {
            return Carbon::parse($month)->format('F Y');
        });

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
}