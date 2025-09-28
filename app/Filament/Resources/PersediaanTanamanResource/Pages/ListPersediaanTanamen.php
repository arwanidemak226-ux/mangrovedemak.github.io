<?php

namespace App\Filament\Resources\PersediaanTanamanResource\Pages;

use App\Filament\Resources\PersediaanTanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersediaanTanamen extends ListRecords
{
    protected static string $resource = PersediaanTanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    protected function canCreate(): bool
{
    return false;
}
}
