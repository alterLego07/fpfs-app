<?php

namespace App\Filament\Resources\FederacionesResource\Pages;

use App\Filament\Resources\FederacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFederaciones extends ListRecords
{
    protected static string $resource = FederacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
