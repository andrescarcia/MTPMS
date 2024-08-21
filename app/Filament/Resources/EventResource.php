<?php

namespace App\Filament\Resources;

use App\Filament\Exports\EventExporter;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
// use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Registros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')->required()->searchable()->preload()->label('Cliente'),
                Forms\Components\TextInput::make('case_number')
                    ->required()->label('Número de caso'),
                Forms\Components\DatePicker::make('date')
                    ->required()->label('Fecha'),
                Forms\Components\Select::make('pais')
                    ->options([
                        'Venezuela' => 'Venezuela',
                        'Costa Rica' => 'Costa Rica',
                        'El Salvador' => 'El Salvador',
                        'Guatemala' => 'Guatemala',
                        'Honduras' => 'Honduras',
                        'Nicaragua' => 'Nicaragua',
                        'Panamá' => 'Panamá',
                        'República Dominicana' => 'República Dominicana',
                        'Puerto Rico' => 'Puerto Rico',
                    ])
                    ->required()
                    ->label('País'),
                Forms\Components\TextInput::make('CC')
                    ->required()->label('CC'),
                Forms\Components\TextInput::make('part_number')
                    ->required()->label('Numero de parte'),
                Forms\Components\TextInput::make('description')
                    ->required()->label('Descripción'),
                // Forms\Components\TextInput::make('quantity')
                //     ->required()
                //     ->numeric(),

                Forms\Components\TextInput::make('quantity')
                    ->required()->label('Cantidad')
                    ->numeric()
                    ->minValue(1)
                    ->live(onBlur: true)
                    ->rules([
                        fn() => function (string $attribute, $value, Closure $fail) {
                            if ($value <= 0) {
                                $fail("La cantidad debe ser un número positivo mayor que cero.");
                            }
                        },
                    ])
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        $set('total_price', self::calculateTotal()($get));
                    })
                ,

                Forms\Components\TextInput::make('provider')
                    ->required()->label('Proveedor'),
                Forms\Components\TextInput::make('unitary_price')
                    ->required()
                    ->label('Precio unitario')
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0.01)
                    ->live(onBlur: true)
                    ->rules([
                        fn() => function (string $attribute, $value, Closure $fail) {
                            if ($value <= 0) {
                                $fail("La cantidad debe ser un número positivo mayor que cero.");
                            }
                        },
                    ])
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        $set('total_price', self::calculateTotal()($get));
                    }),

                // Forms\Components\TextInput::make('total_price')
                //     ->required()
                //     ->numeric()->prefix('$'),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->label('Precio total')
                    ->numeric()
                    ->prefix('$')
                    ->readOnly()
                    ->dehydrated(true)
                    ->afterStateHydrated(function (Get $get, Set $set) {
                        $set('total_price', self::calculateTotal()($get));
                    }),
                Forms\Components\Select::make('priority')
                    ->options([
                        'alta' => 'Alta',
                        'media' => 'Media',
                        'baja' => 'Baja',
                    ])
                    ->required()
                    ->label('Prioridad'),
                Forms\Components\TextInput::make('OC')
                    ->required()->label('OC'),
                Forms\Components\TextInput::make('ETA')
                    ->required()->label('ETA'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('case_number')
                    ->searchable()
                    ->label('Número de caso'),
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable()
                    ->sortable()
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('Fecha'),
                Tables\Columns\TextColumn::make('pais')
                    ->searchable()
                    ->label('País'),
                Tables\Columns\TextColumn::make('CC')
                    ->searchable()
                    ->label('CC')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('part_number')
                    ->searchable()
                    ->label('Número de parte'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->label('Descripción')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable()
                    ->label('Cantidad'),
                Tables\Columns\TextColumn::make('provider')
                    ->searchable()
                    ->label('Proveedor'),
                Tables\Columns\TextColumn::make('unitary_price')
                    ->numeric()
                    ->sortable()
                    ->label('Precio unitario')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->label('Precio total')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('priority')
                    ->searchable()
                    ->label('Prioridad'),
                Tables\Columns\TextColumn::make('OC')
                    ->searchable()
                    ->label('OC')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ETA')
                    ->searchable()
                    ->label('ETA')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Modificado'),
            ])
            ->filters([
                DateRangeFilter::make('created_at')->label('Creado entre dos fechas'),

                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'alta' => 'Alta',
                        'media' => 'Media',
                        'baja' => 'Baja',
                    ])
                    ->label('Prioridad'),
                Tables\Filters\SelectFilter::make('pais')
                    ->options([
                        'Venezuela' => 'Venezuela',
                        'Costa Rica' => 'Costa Rica',
                        'El Salvador' => 'El Salvador',
                        'Guatemala' => 'Guatemala',
                        'Honduras' => 'Honduras',
                        'Nicaragua' => 'Nicaragua',
                        'Panamá' => 'Panamá',
                        'República Dominicana' => 'República Dominicana',
                        'Puerto Rico' => 'Puerto Rico',
                    ])
                    ->label('País'),
                        // obtener la lista de clientes y mostrar en el filtro
                    Tables\Filters\SelectFilter::make('client.name')
                    ->relationship('client', 'name')
                    ->label('Cliente'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('pdf') 
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Event $event) => route('pdf', $event))
                    ->openUrlInNewTab(), 
            ])
            ->headerActions([
                // ExportAction::make()->exporter(EventExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
    public static function calculateTotal(): Closure
    {
        return function (Get $get): float {
            $quantity = floatval($get('quantity') ?? 0);
            $unitaryPrice = floatval($get('unitary_price') ?? 0);
            return $quantity * $unitaryPrice;
        };
    }

}
