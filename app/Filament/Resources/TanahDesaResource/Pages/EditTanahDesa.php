<?php

namespace App\Filament\Resources\TanahDesaResource\Pages;

use App\Filament\Resources\TanahDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTanahDesa extends EditRecord
{
    protected static string $resource = TanahDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
