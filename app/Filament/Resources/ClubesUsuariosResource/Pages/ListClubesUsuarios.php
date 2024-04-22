<?php

namespace App\Filament\Resources\ClubesUsuariosResource\Pages;

use App\Filament\Resources\ClubesUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClubesUsuarios extends ListRecords
{
    protected static string $resource = ClubesUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
