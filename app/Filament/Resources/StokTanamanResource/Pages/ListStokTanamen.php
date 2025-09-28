<?php

namespace App\Filament\Resources\StokTanamanResource\Pages;

use App\Filament\Resources\StokTanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStokTanamen extends ListRecords
{
    protected static string $resource = StokTanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
