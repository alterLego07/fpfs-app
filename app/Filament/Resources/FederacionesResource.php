<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FederacionesResource\Pages;
use App\Filament\Resources\FederacionesResource\RelationManagers;
use App\Models\Federaciones;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Collection;
use Filament\Forms\Get;


// Modelos
use App\Models\Ciudades;


class FederacionesResource extends Resource
{
    protected static ?string $model = Federaciones::class;

    protected static ?string $navigationIcon = 'heroicon-m-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_federacion')
                    ->label('Federación')
                    ->required()
                    ->maxLength(45)
                    ->default(null),
                Forms\Components\Select::make('departamento_id')
                    ->relationship('departamento', 'nombre')
                    ->required()
                    ->live(onBlur: true)
                    ->preload(),
                    // ->loadingMessage('Cargando Departamentos..'),
                Forms\Components\Select::make('ciudad_id')
                    ->label('Ciudad')
                    ->options(fn (Get $get): Collection => Ciudades::query()
                        ->where('departamento_id', $get('departamento_id'))
                        ->pluck('descripcion', 'id'))
                    ->preload()
                    ->required()
                    ->loadingMessage('Cargando Ciudades ..'),
                Forms\Components\DatePicker::make('fecha_afiliacion')
                    ->label('Fecha de Afiliación'),
                Forms\Components\Textarea::make('observaciones')
                    ->label('Observaciones')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Registro de Firmas')
                    ->image()
                    ->imageEditor()
                    ->directory('federaciones/firmas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_federacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudad.descripcion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_afiliacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Registro de Firmas'),
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
            'index' => Pages\ListFederaciones::route('/'),
            'create' => Pages\CreateFederaciones::route('/create'),
            'edit' => Pages\EditFederaciones::route('/{record}/edit'),
        ];
    }
}
