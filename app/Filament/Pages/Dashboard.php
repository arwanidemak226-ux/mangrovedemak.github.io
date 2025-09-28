<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\JumlahTanamanPerSpesiesChart;

class Dashboard extends BaseDashboard
{   
    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected function getHeaderWidgets(): array
    {
        return [
            JumlahTanamanPerSpesiesChart::class,
        ];
    }
}
