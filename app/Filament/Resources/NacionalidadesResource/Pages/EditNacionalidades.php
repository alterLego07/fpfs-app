<?php

namespace App\Filament\Resources\NacionalidadesResource\Pages;

use App\Filament\Resources\NacionalidadesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNacionalidades extends EditRecord
{
    protected static string $resource = NacionalidadesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
