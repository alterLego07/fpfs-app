<?php

namespace App\Filament\Resources\TipoDocumentosResource\Pages;

use App\Filament\Resources\TipoDocumentosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoDocumentos extends EditRecord
{
    protected static string $resource = TipoDocumentosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
