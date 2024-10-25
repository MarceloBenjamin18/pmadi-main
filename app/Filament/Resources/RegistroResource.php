<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroResource\Pages;
use App\Filament\Resources\RegistroResource\RelationManagers;
use App\Models\Registro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;

class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Información General')
                        ->schema([
                            Select::make('distrito')
                                ->label('Distrito Municipal')
                                ->options([
                                    'distrito_1' => 'Distrito 1',
                                    'distrito_2' => 'Distrito 2',
                                    'distrito_3' => 'Distrito 3',
                                    'distrito_4' => 'Distrito 4',
                                    'distrito_5' => 'Distrito 5',
                                    'distrito_6' => 'Distrito 6',
                                ]),
                            Forms\Components\TextInput::make('numero_registro')
                                ->label('Número de Registro'),
                            Forms\Components\TextInput::make('denominacion_anterior')
                                ->label('Denominación Anterior'),
                            Forms\Components\TextInput::make('denominacion_actual')
                                ->label('Denominación Actual'),


                            CheckboxList::make('actual_denominacion')
                                ->label('ESTADO ACTUAL DEL FOLIO REAL O PARTIDA')
                                ->options([
                                    'reposicion' => 'REPOSICIÓN',
                                    'actualizacion' => 'ACTUALIZACIÓN',
                                    'cambio_matricula' => 'CAMBIO A MATRICULA',
                                    'cambio_razon_social' => 'CAMBIO DE RAZON SOCIAL',
                                    'cambio_jurisdiccion' => 'CAMBIO DE JURISDICCIÓN',
                                    'solic_transferencia' => 'SOLIC. DE TRANSFERENCIA',
                                ])
                        ]),

                    Forms\Components\Wizard\Step::make('Detalles de la Escritura')
                        ->schema([
                            Forms\Components\TextInput::make('escritura_publica')
                                ->label('Escritura Pública'),
                            Forms\Components\DatePicker::make('fecha_escritura')
                                ->label('Fecha de la Escritura'),
                            Forms\Components\TextInput::make('notaria')
                                ->label('Notaría'),
                            Forms\Components\TextInput::make('ubicacion_notaria')
                                ->label('Ubicación de la Notaría'),
                        ]),

                    Forms\Components\Wizard\Step::make('Registro y Archivo')
                        ->schema([
                            Forms\Components\TextInput::make('folio_real')
                                ->label('Folio Real'),
                            Forms\Components\TextInput::make('registro')
                                ->label('Registro'),
                            Forms\Components\TextInput::make('libro')
                                ->label('Libro'),
                            Forms\Components\TextInput::make('numero')
                                ->label('Número'),
                        ]),

                    Forms\Components\Wizard\Step::make('Actualizaciones y Otros')
                        ->schema([
                            Forms\Components\TextInput::make('unidad_ejecutiva')
                                ->label('Unidad Ejecutiva'),
                            Forms\Components\TextInput::make('actualizador')
                                ->label('Actualizador'),
                            Forms\Components\DatePicker::make('fecha_actualizacion')
                                ->label('Fecha de Actualización'),
                            Forms\Components\TextInput::make('codigo_catastral')
                                ->label('Código Catastral'),
                            Forms\Components\TextInput::make('superficie_total')
                                ->label('Superficie Total y Superficie Escriturada'),
                            Forms\Components\TextInput::make('registrado_por')
                                ->label('Registrado Por'),
                            Forms\Components\TextInput::make('observaciones')
                                ->label('Otras Observaciones'),
                        ]),
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Aquí puedes definir las columnas de la tabla
            ])
            ->filters([
                // Aquí puedes definir los filtros de la tabla
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
            // Aquí puedes definir relaciones si las tienes
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistros::route('/'),
            'create' => Pages\CreateRegistro::route('/create'),
            'edit' => Pages\EditRegistro::route('/{record}/edit'),
        ];
    }
}
