<?php

namespace App\Filament\Resources\JugadoresResource\Pages;

use App\Filament\Resources\JugadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJugadores extends EditRecord
{
    protected static string $resource = JugadoresResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {

        unset($data['user_id']);
        return $data;
    }

}
