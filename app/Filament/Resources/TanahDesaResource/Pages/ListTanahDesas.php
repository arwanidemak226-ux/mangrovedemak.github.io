<?php

namespace App\Filament\Resources\TanahDesaResource\Pages;

use App\Filament\Resources\TanahDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTanahDesas extends ListRecords
{
    protected static string $resource = TanahDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
