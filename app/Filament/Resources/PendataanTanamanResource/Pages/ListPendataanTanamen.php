<?php

namespace App\Filament\Resources\PendataanTanamanResource\Pages;

use App\Filament\Resources\PendataanTanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendataanTanamen extends ListRecords
{
    protected static string $resource = PendataanTanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
