<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JugadoresResource\Pages;
use App\Filament\Resources\JugadoresResource\RelationManagers;
use App\Models\Clubes;
use App\Models\Jugadores;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Resources\Resource;
use Filament\Resources\Table as ResourceTable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Columns;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;

class JugadoresResource extends Resource
{
    protected static ?string $model = Jugadores::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'jugadores';

    public static function form(Form $form): Form
    {
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
                    ->unique(ignorable: fn ($record) => $record)
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(50),
                Forms\Components\TextInput::make('nro_ficha_anterior')
                    ->maxLength(50)
                    ->disabledOn('edit')
                    ->default(null),
                Forms\Components\Select::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'descripcion')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_nacimiento'),
                Forms\Components\Select::make('nacionalidad_id')
                    ->relationship('nacionalidad', 'descripcion')
                    ->default(null),
                Forms\Components\Select::make('club_primer_fichaje')
                    ->label('Club Primer Fichaje')
                    ->options(function() {
                        return Clubes::customSelect(auth()->user()->id)
                            ->pluck('nombre_club', 'id');
                    })
                    //->default(null)
                    ->required(),
                Forms\Components\Select::make('club_origen_id')
                    ->label('Club Definitivo')
                    ->options(function() {
                        return Clubes::customSelect(auth()->user()->id)
                            ->pluck('nombre_club', 'id');
                    })
                    ->default(null)
                    ->required(),
                Forms\Components\Select::make('club_id')
                    ->label('Club Actual')
                    ->relationship('club', 'nombre_club')
                    ->default(null),        
                Forms\Components\Toggle::make('prestamo')
                    ->label('Prestamo')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false),
                Forms\Components\DatePicker::make('tiempo_prestamo')
                    ->label('Tiempo de Prestamo'),
                Forms\Components\Textarea::make('observaciones')
                    ->label('Observaciones')
                    ->maxLength(500),
                Forms\Components\FileUpload::make('fotografia')
                    ->label('Foto del Jugador')
                    ->image()
                    ->avatar()
                    ->directory('jugadores/foto'),
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
                Forms\Components\FileUpload::make('documentos_extra')
                    ->preserveFilenames()
                    ->directory('jugadores/documento'),
                Forms\Components\DatePicker::make('fecha_vencimiento_cedula'),
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
                Forms\Components\DatePicker::make('fecha_habilitacion')
                    ->label('Fecha de Habilitación'),
                Forms\Components\Toggle::make('estado')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
                Forms\Components\Radio::make('sexo')
                    ->options([
                        '1' => 'Masculino',
                        '2' => 'Femenino',
                        '3' => 'Otro'
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('fotografia'),
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
                Tables\Columns\TextColumn::make('categoria.descripcion')
                    ->label('Categoria')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nacionalidad.descripcion')
                    ->label('Nacionalidad')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('club_primer_ficha.nombre_club')
                    ->label('Club Primer Fichaje')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('club_origen.nombre_club')
                    ->label('Club Definitivo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('club.nombre_club')
                    ->label('Club Actual')
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('prestamo')
                    ->label('Préstamo'),
                Tables\Columns\TextColumn::make('tiempo_prestamo')
                    ->label('Tiempo de Préstamo')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('observaciones')
                    ->label('Observaciones')
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->observaciones;
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario Creacion')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('habilitado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Inhabilitado' => 'danger',
                        'Habilitado' => 'success',
                        default => 'gray',
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Inactivo' => 'danger',
                        'Activo' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Masculino' => 'danger',
                        'Femenino' => 'success',
                        default => 'gray',
                    })
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
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'descripcion'),
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        '1' => 'Activo',
                        '2' => 'Inactivo',
                    ]),
                Tables\Filters\SelectFilter::make('habilitado')
                    ->label('Habilitacion')
                    ->options([
                        '1' => 'Habilitado',
                        '2' => 'Inhabilitado',
                        '3' => 'Libre'
                    ]),
                Tables\Filters\SelectFilter::make('sexo')
                    ->options([
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                        'Otro' => 'Otro'
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Ver Planilla')
                    ->icon('heroicon-o-qr-code')
                    ->url(fn(Jugadores $record): string => static::getUrl('vista', ['record' => $record])),
                Action::make('Ver PDF')
                    ->icon('heroicon-o-document')
                    ->url(fn(Jugadores $record) => route('jugadores.pdf.download', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
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
            'vista' => Pages\ViewJugadores::route('/{record}/vista'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $usuario = User::find(auth()->user()->id);

        $federacion = $usuario->federacion()->get();

        if ($federacion) {
            $federaciones = [];
            foreach ($federacion as $value) {
                if ($value->estado == 1) {
                    array_push($federaciones, $value->federacion_id);
                }
            }

            $clubes = Clubes::whereIn('federacion_id', $federaciones)->get();

            $club = [];

            foreach ($clubes as $valor) {
                array_push($club, $valor->id);
            }
        }

        if ($usuario->clubes()->first()) {
            return parent::getEloquentQuery()
                ->where('club_id', $usuario->clubes()->first()->club_id);
        } elseif (count($federaciones) > 0) {
            return parent::getEloquentQuery()->whereIn('club_id', $club);
        } else {
            return parent::getEloquentQuery()
                ->whereNotNull('created_at');
        }
    }
}