<?php

namespace App\Filament\Resources\NacionalidadesResource\Pages;

use App\Filament\Resources\NacionalidadesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNacionalidades extends ListRecords
{
    protected static string $resource = NacionalidadesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
