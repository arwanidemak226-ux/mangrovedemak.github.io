<?php

namespace App\Filament\Resources\StokTanamanResource\Pages;

use App\Filament\Resources\StokTanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStokTanaman extends EditRecord
{
    protected static string $resource = StokTanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
