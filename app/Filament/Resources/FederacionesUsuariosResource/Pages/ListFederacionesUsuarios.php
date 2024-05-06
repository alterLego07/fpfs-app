<?php

namespace App\Filament\Resources\FederacionesUsuariosResource\Pages;

use App\Filament\Resources\FederacionesUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFederacionesUsuarios extends ListRecords
{
    protected static string $resource = FederacionesUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
