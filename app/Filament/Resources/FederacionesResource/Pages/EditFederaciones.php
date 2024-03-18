<?php

namespace App\Filament\Resources\FederacionesResource\Pages;

use App\Filament\Resources\FederacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFederaciones extends EditRecord
{
    protected static string $resource = FederacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
