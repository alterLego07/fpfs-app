<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JugadoresResource\Pages;
use App\Filament\Resources\JugadoresResource\RelationManagers;
use App\Models\Jugadores;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
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
        
    // dd(auth()->user()->id);
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_jugador')
                    ->label('Nombre')
                    ->maxLength(60)
                    ->required(),
                Forms\Components\TextInput::make('apellido_jugador')
                    ->label('Apellido')
                    ->maxLength(60)
                    ->required(),
                Forms\Components\Select::make('tipo_documento_id')
                    ->label('Tipo de Documento')
                    ->relationship('tipodocumento', 'descripcion')
                    ->required(),
                Forms\Components\TextInput::make('documento')
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(50),
                Forms\Components\TextInput::make('nro_ficha_anterior')
                    ->maxLength(50)
                    ->disabledOn('edit')
                    ->default(null),
                Forms\Components\DatePicker::make('fecha_nacimiento'),
                Forms\Components\Select::make('nacionalidad_id')
                    ->relationship('nacionalidad', 'descripcion')
                    ->default(null),
                Forms\Components\Select::make('club_id')
                    ->relationship('club', 'nombre_club')
                    ->default(null),
                Forms\Components\FileUpload::make('fotografia')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->imageEditorViewportWidth('1920')
                    ->imageEditorViewportHeight('1080'),
                Forms\Components\FileUpload::make('foto_documento_frontal')
                    ->image()
                    ->imageEditor()
                    ->imageEditorViewportWidth('1920')
                    ->imageEditorViewportHeight('1080'),
                Forms\Components\FileUpload::make('foto_documento_dorsal')
                    ->image()
                    ->imageEditor()
                    ->imageEditorViewportWidth('1920')
                    ->imageEditorViewportHeight('1080'),
                Forms\Components\DatePicker::make('fecha_vencimiento_cedula'),
                Forms\Components\TextInput::make('codigo_qr')
                    ->label('Codigo QR')
                    ->maxLength(200)
                    ->default(null),
                Forms\Components\Select::make('user_id')
                    ->label('Usuario Creador')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->default(auth()->user()->id),
                Forms\Components\Radio::make('habilitado')
                    ->label('Estado Pase')
                    ->options([
                        1 => 'Habilitado',
                        2 => 'Inhabilitado',
                        3 => 'Libre'
                    ])
                    ->default('1'),
                Forms\Components\Toggle::make('estado')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
                Forms\Components\Radio::make('sexo')
                    ->options([
                        '1' => 'Masculino',
                        '2' => 'Femenino',
                        '3' => 'Otro'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_jugador')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apellido_jugador')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('documento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipodocumento.descripcion')
                    ->label('Tipo de Documento')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nro_ficha_anterior')
                    ->label('Nro. Ficha Anterior')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nacionalidad.descripcion')
                    ->label('Nacionalidad')
                    // ->listWithLineBreaks()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('club.nombre_club')
                    ->label('Club Actual')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario Creacion')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('habilitado')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('estado'),
                Tables\Columns\TextColumn::make('sexo')
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'gray',
                        '2' => 'warning',
                        '3' => 'success',
                    })
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
            'index' => Pages\ListJugadores::route('/'),
            'create' => Pages\CreateJugadores::route('/create'),
            'edit' => Pages\EditJugadores::route('/{record}/edit'),
        ];
    }
}
