<?php

namespace App\Filament\Resources\CiudadesResource\Pages;

use App\Filament\Resources\CiudadesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCiudades extends ListRecords
{
    protected static string $resource = CiudadesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
