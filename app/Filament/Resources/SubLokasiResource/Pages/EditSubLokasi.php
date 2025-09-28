<?php

namespace App\Filament\Resources\SubLokasiResource\Pages;

use App\Filament\Resources\SubLokasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubLokasi extends EditRecord
{
    protected static string $resource = SubLokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
