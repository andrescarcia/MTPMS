<?php

namespace App\Filament\Exports;

use App\Models\Event;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
class EventExporter extends Exporter
{
    protected static ?string $model = Event::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('id')
            //     ->label('ID'),
            ExportColumn::make('case_number'),
            ExportColumn::make('date'),
            ExportColumn::make('pais'),
            // ExportColumn::make('CC'),
            // ExportColumn::make('part_number'),
            // ExportColumn::make('description'),
            // ExportColumn::make('quantity'),
            // ExportColumn::make('provider'),
            // ExportColumn::make('unitary_price'),
            // ExportColumn::make('total_price'),
            // ExportColumn::make('priority'),
            // ExportColumn::make('OC'),
            // ExportColumn::make('ETA'),
            // ExportColumn::make('client_id'),
            // ExportColumn::make('created_at'),
            // ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your event export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
