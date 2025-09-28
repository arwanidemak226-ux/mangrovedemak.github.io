<?php

namespace App\Filament\Resources\MangroveResource\Pages;

use App\Filament\Resources\MangroveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMangrove extends EditRecord
{
    protected static string $resource = MangroveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
