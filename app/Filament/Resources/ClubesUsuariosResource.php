<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubesUsuariosResource\Pages;
use App\Filament\Resources\ClubesUsuariosResource\RelationManagers;
use App\Models\ClubesUsuarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ClubesUsuariosResource extends Resource
{
    protected static ?string $model = ClubesUsuarios::class;
    protected static ?string $modelLabel = 'Clubes Usuarios';
    protected static ?string $pluralModelLabel = 'Clubes Usuarios';
    protected static ?string $navigationGroup = 'Seguridad';
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('club_id')
                    ->relationship('club', 'nombre_club')
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->required()
                    ->searchable()
                    ->relationship('usuario', 'name'),
                Select::make('estado')
                    ->options([
                        '1' => 'Activo',
                        '2' => 'Inactivo'
                    ])
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Clubes Usuarios')
            ->columns([
                TextColumn::make('club.nombre_club')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('usuario.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListClubesUsuarios::route('/'),
            'create' => Pages\CreateClubesUsuarios::route('/create'),
            'edit' => Pages\EditClubesUsuarios::route('/{record}/edit'),
        ];
    }
}
