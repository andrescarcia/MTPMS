<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopPartsWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::select('part_number', \DB::raw('count(*) as total_count'), 'id')
                    ->groupBy('part_number', 'id')  // Incluye 'id' en el groupBy
                    ->orderBy('total_count', 'desc')
                    ->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('part_number')
                    ->label('Número de Parte'),
                Tables\Columns\TextColumn::make('total_count')
                    ->label('Cantidad Total')
                    ->sortable(),
            ]);
    }
}
