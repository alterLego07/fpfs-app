<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoDocumentosResource\Pages;
use App\Filament\Resources\TipoDocumentosResource\RelationManagers;
use App\Models\Tipo_documentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoDocumentosResource extends Resource
{
    protected static ?string $model = Tipo_documentos::class;
    protected static ?string $navigationLabel = 'Tipo Documentos';
    protected static ?string $navigationGroup = 'Configuraciones';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoDocumentos::route('/'),
            'create' => Pages\CreateTipoDocumentos::route('/create'),
            'edit' => Pages\EditTipoDocumentos::route('/{record}/edit'),
        ];
    }
}
