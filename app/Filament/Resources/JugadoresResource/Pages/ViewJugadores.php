<?php

namespace App\Filament\Resources\JugadoresResource\Pages;

use App\Filament\Resources\JugadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJugadores extends ViewRecord
{
    protected static string $resource = JugadoresResource::class;

    protected static string $view = 'filament.resources.jugadores-resource.pages.vista';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
