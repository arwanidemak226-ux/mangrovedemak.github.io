<?php

namespace App\Filament\Resources\PersediaanTanamanResource\Pages;

use App\Filament\Resources\PersediaanTanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersediaanTanaman extends EditRecord
{
    protected static string $resource = PersediaanTanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
