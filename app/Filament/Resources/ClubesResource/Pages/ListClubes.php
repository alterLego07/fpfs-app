<?php

namespace App\Filament\Resources\ClubesResource\Pages;

use App\Filament\Resources\ClubesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClubes extends ListRecords
{
    protected static string $resource = ClubesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
