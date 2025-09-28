<?php

namespace App\Filament\Resources\SepadanSungaiResource\Pages;

use App\Filament\Resources\SepadanSungaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSepadanSungai extends EditRecord
{
    protected static string $resource = SepadanSungaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
