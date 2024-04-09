<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubesResource\Pages;
use App\Filament\Resources\ClubesResource\RelationManagers;
use App\Models\Clubes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClubesResource extends Resource
{
    protected static ?string $model = Clubes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_club')
                    ->label('Nombre del Club')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\Select::make('federacion_id')
                    ->relationship('federacion', 'nombre_federacion')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_afiliacion'),
                Forms\Components\Select::make('ciudad_id')
                    ->relationship('ciudad', 'descripcion')
                    ->required(),
                Forms\Components\Select::make('departamento_id')
                    ->relationship('departamento', 'nombre')
                    ->required(),
                Forms\Components\RichEditor::make('observacion')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_club')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_afiliacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('federacion.nombre_federacion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ciudad.descripcion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha Creacion')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha Actualizacion')
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
            'index' => Pages\ListClubes::route('/'),
            'create' => Pages\CreateClubes::route('/create'),
            'edit' => Pages\EditClubes::route('/{record}/edit'),
        ];
    }
}
