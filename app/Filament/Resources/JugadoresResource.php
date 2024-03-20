<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JugadoresResource\Pages;
use App\Filament\Resources\JugadoresResource\RelationManagers;
use App\Models\Jugadores;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JugadoresResource extends Resource
{
    protected static ?string $model = Jugadores::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_jugador')
                    ->maxLength(60)
                    ->required(),
                Forms\Components\TextInput::make('apellido_jugador')
                    ->maxLength(60)
                    ->required(),
                Forms\Components\Select::make('tipo_documento_id')
                    ->relationship('tipodocumento', 'descripcion')
                    ->required(),
                Forms\Components\TextInput::make('documento')
                    ->required()
                    ->unique()
                    ->maxLength(50),
                Forms\Components\TextInput::make('nro_ficha_anterior')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\DatePicker::make('fecha_nacimiento'),
                Forms\Components\Select::make('nacionalidad_id')
                    ->relationship('nacionalidad', 'descripcion')
                    ->default(null),
                Forms\Components\Select::make('club_id')
                    ->relationship('club', 'nombre_club')
                    ->default(null),
                Forms\Components\FileUpload::make('fotografia')
                    ->image(),
                Forms\Components\FileUpload::make('foto_documento_frontal')
                    ->image(),
                Forms\Components\FileUpload::make('foto_documento_dorsal')
                    ->image(),
                Forms\Components\DatePicker::make('fecha_vencimiento_cedula'),
                Forms\Components\TextInput::make('codigo_qr')
                    ->maxLength(200)
                    ->default(null),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('habilitado')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('estado')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('sexo')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_jugador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_jugador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipodocumento.descripcion')
                    ->label('Tipo de Documento')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nro_ficha_anterior')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nacionalidad_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('club.descripcion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('habilitado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListJugadores::route('/'),
            'create' => Pages\CreateJugadores::route('/create'),
            'edit' => Pages\EditJugadores::route('/{record}/edit'),
        ];
    }
}
