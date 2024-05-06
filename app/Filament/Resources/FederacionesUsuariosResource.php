<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FederacionesUsuariosResource\Pages;
use App\Filament\Resources\FederacionesUsuariosResource\RelationManagers;
use App\Models\FederacionesUsuarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FederacionesUsuariosResource extends Resource
{
    protected static ?string $model = FederacionesUsuarios::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Federacion Usuario';
    protected static ?string $pluralModelLabel = 'Federaciones Usuarios';
    protected static ?string $navigationGroup = 'Seguridad';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('usuario', 'name')
                    ->required(),
                Forms\Components\Select::make('federacion_id')
                    ->relationship('federacion', 'nombre_federacion')
                    ->required(),
                Forms\Components\Radio::make('estado')
                    ->label('Estado Pase')
                    ->options([
                        1 => 'Activo',
                        2 => 'Inactivo',
                    ])
                    ->default(1),
                Forms\Components\DatePicker::make('fecha_inactivacion'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('usuario.name')
                    ->label('Usuario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('federacion.nombre_federacion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inactivacion')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListFederacionesUsuarios::route('/'),
            'create' => Pages\CreateFederacionesUsuarios::route('/create'),
            'edit' => Pages\EditFederacionesUsuarios::route('/{record}/edit'),
        ];
    }
}
