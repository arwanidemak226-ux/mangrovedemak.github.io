<?php

namespace App\Filament\Widgets;

use App\Models\PendataanTanaman;
use Filament\Widgets\ChartWidget;

class KondisiTanamanPieChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';

    protected static ?string $heading = 'Kondisi Tanaman';

    protected static string $color = 'success';

    protected function getData(): array
    {
            $kondisiTanaman = PendataanTanaman::select('kondisi_tanaman')
            ->get()
            ->groupBy('kondisi_tanaman');

        $labels = $kondisiTanaman->keys();
        $data = $kondisiTanaman->map(fn ($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'Total Tanaman',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#10B981', // Hijau untuk 'Baik'
                        '#F59E0B', // Kuning untuk 'Kurang Baik'
                        '#EF4444', // Merah untuk 'Mati'
                    ],
                ],
            ],
            'labels' => $labels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
