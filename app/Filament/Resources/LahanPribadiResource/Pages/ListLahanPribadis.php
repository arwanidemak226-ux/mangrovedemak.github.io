<?php

namespace App\Filament\Resources\LahanPribadiResource\Pages;

use App\Filament\Resources\LahanPribadiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLahanPribadis extends ListRecords
{
    protected static string $resource = LahanPribadiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
