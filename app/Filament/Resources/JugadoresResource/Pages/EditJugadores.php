<?php

namespace App\Filament\Resources\JugadoresResource\Pages;

use App\Filament\Resources\JugadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJugadores extends EditRecord
{
    protected static string $resource = JugadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
