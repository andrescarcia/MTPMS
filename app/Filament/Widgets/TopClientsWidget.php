<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopClientsWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Client::withCount('events')
                    ->orderBy('events_count', 'desc')
                    ->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('events_count')
                    ->label('Eventos')
                    ->sortable(),
            ]);
    }
}
