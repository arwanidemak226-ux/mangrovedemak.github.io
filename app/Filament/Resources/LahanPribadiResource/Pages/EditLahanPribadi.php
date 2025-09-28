<?php

namespace App\Filament\Resources\LahanPribadiResource\Pages;

use App\Filament\Resources\LahanPribadiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLahanPribadi extends EditRecord
{
    protected static string $resource = LahanPribadiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
