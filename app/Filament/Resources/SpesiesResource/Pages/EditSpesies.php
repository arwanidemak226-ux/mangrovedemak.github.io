<?php

namespace App\Filament\Resources\SpesiesResource\Pages;

use App\Filament\Resources\SpesiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpesies extends EditRecord
{
    protected static string $resource = SpesiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
