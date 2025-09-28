<?php

namespace App\Filament\Resources\LokasiPenanamanResource\Pages;

use App\Filament\Resources\LokasiPenanamanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLokasiPenanaman extends EditRecord
{
    protected static string $resource = LokasiPenanamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
