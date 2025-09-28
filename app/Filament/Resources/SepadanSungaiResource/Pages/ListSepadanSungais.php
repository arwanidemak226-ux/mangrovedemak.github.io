<?php

namespace App\Filament\Resources\SepadanSungaiResource\Pages;

use App\Filament\Resources\SepadanSungaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSepadanSungais extends ListRecords
{
    protected static string $resource = SepadanSungaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
