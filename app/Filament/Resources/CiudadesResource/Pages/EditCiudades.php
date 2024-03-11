<?php

namespace App\Filament\Resources\CiudadesResource\Pages;

use App\Filament\Resources\CiudadesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCiudades extends EditRecord
{
    protected static string $resource = CiudadesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
