<?php

namespace App\Filament\Resources\ClubesUsuariosResource\Pages;

use App\Filament\Resources\ClubesUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClubesUsuarios extends EditRecord
{
    protected static string $resource = ClubesUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
