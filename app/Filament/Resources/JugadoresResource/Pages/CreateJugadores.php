<?php

namespace App\Filament\Resources\JugadoresResource\Pages;

use App\Filament\Resources\JugadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJugadores extends CreateRecord
{
    protected static string $resource = JugadoresResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
         $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
