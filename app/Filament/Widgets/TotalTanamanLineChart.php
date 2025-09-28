<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PendataanTanaman;
use Carbon\Carbon;

class TotalTanamanLineChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';

     protected static ?string $heading = 'Total Tanaman per Bulan';

    protected function getData(): array
    {
            $data = PendataanTanaman::query()
            ->selectRaw('DATE_FORMAT(tanggal_pendataan, "%Y-%m") as month, sum(jumlah_tanaman) as total_tanaman')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month')->map(fn ($month) => Carbon::parse($month)->isoFormat('MMMM Y'));
        $values = $data->pluck('total_tanaman');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Tanaman',
                    'data' => $values,
                    'borderColor' => '#36A2EB',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
