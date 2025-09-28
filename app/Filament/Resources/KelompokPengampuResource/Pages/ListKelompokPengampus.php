<?php

namespace App\Filament\Resources\KelompokPengampuResource\Pages;

use App\Filament\Resources\KelompokPengampuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelompokPengampus extends ListRecords
{
    protected static string $resource = KelompokPengampuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
