<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubesResource\Pages;
use App\Filament\Resources\ClubesResource\RelationManagers;
use App\Models\Clubes;
use App\Models\User;
use App\Models\FederacionesUsuarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\CreateRecord;

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
                    ->label('Federación')
                    ->relationship('federacion', 'nombre_federacion')
                    ->required()
                    ->options(function() {
                        $userId = auth()->id();
                        return FederacionesUsuarios::join('federaciones', 'federaciones.id', '=', 'federaciones_usuarios.federacion_id')
                        ->where('federaciones_usuarios.user_id', $userId)
                        ->pluck('federaciones.nombre_federacion', 'federaciones.id');
                    }),
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
                    ->label('Registro de Firmas')
                    ->image()
                    ->directory('clubes/registro'),
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
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Registro de Firmas'),
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


     /**
     * The function `getEloquentQuery` retrieves data based on the user's federations and clubs in a PHP
     * Laravel application.
     * 
     * @return Builder The `getEloquentQuery` function returns an Eloquent query based on certain
     * conditions.
     */
    public static function getEloquentQuery(): Builder
    {
        $usuario = User::find(auth()->user()->id);

        $federacion = $usuario->federacion()->get();

        if($federacion){
            $federaciones = [];
            foreach($federacion as $value){
                if($value->estado == 1){
                    array_push($federaciones, $value->federacion_id);
                }
            }
        }

        if(count($federaciones) > 0){
            return parent::getEloquentQuery()->whereIn('federacion_id', $federaciones);
        }else{
            return parent::getEloquentQuery()->whereNotNull('created_at');
        }

        
    }
}
