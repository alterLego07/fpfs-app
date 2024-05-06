<?php

namespace App\Filament\Resources\FederacionesUsuariosResource\Pages;

use App\Filament\Resources\FederacionesUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFederacionesUsuarios extends EditRecord
{
    protected static string $resource = FederacionesUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
