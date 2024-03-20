<?php

namespace App\Filament\Resources\JugadoresResource\Pages;

use App\Filament\Resources\JugadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJugadores extends ListRecords
{
    protected static string $resource = JugadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
