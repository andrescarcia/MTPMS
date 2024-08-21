<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Event;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $growthRate = User::where('created_at', '>=', now()->subMonth())->count(); // Por ejemplo, usuarios nuevos este mes
        $totalEvents = Event::count();
        $totalRevenue = Event::sum('total_price');
        $totalQuantity = Event::sum('quantity');
        $totalClients = Client::count();

        return [
            // Stat::make('Usuarios Totales', $totalUsers)
            //     ->description('Tendencia: ' . ($growthRate > 0 ? '+' : '') . $growthRate . ' usuarios este mes')
            //     ->chart([20, 30, 50, 70, 100, $totalUsers]), 
            // Stat::make('Eventos Totales', $totalEvents)
            //     ->description('Total de eventos registrados')
            //     ->chart([50, 60, 75, 80, 100, $totalEvents]),
            // Stat::make('Gastos totales', '$' . number_format($totalRevenue, 2))
            //     ->description('Gastos generados por todos los eventos')
            //     ->chart([5000, 10000, 20000, 25000, $totalRevenue]),
            // Stat::make('Total de Piezas Compradas', $totalQuantity)
            //     ->description('Total de piezas compradas en todos los eventos')
            //     ->chart([100, 200, 300, 400, $totalQuantity]), 
            // Stat::make('Clientes Totales', $totalClients)
            //     ->description('Total de clientes registrados')
            //     ->chart([10, 20, 30, 40, $totalClients]),
            //     // total de eventos con prioridad alta
            // Stat::make('Eventos con Prioridad Alta', Event::where('priority', 'alta')->count())
            //     ->description('Total de eventos con prioridad alta')
            //     ->chart([5, 10, 15, 20, 25, 30, 35, 40, 45, 50]),
            Stat::make('Usuarios Totales', $totalUsers)
                ->description('Tendencia: ' . ($growthRate > 0 ? '+' : '') . $growthRate . ' usuarios este mes')
                ->chart([20, 30, 50, 70, 100, $totalUsers])
                ->icon('heroicon-o-user-group')
                ->color('success'),
            Stat::make('Eventos Totales', $totalEvents)
                ->description('Total de eventos registrados')
                ->chart([50, 60, 75, 80, 100, $totalEvents])
                ->icon('heroicon-o-document-check')
                ->color('primary'),
            Stat::make('Gastos Totales', '$' . number_format($totalRevenue, 2))
                ->description('Gastos generados por todos los eventos')
                ->chart([5000, 10000, 20000, 25000, $totalRevenue])
                ->icon('heroicon-o-currency-dollar')
                ->color('danger'),
            Stat::make('Total de Piezas Compradas', $totalQuantity)
                ->description('Total de piezas compradas en todos los eventos')
                ->chart([100, 200, 300, 400, $totalQuantity])
                ->icon('heroicon-o-cube')
                ->color('warning'),
            Stat::make('Clientes Totales', $totalClients)
                ->description('Total de clientes registrados')
                ->chart([10, 20, 30, 40, $totalClients])
                ->icon('heroicon-o-user')
                ->color('info'),
            Stat::make('Eventos con Prioridad Alta', Event::where('priority', 'alta')->count())
                ->description('Total de eventos con prioridad alta')
                ->chart([5, 10, 15, 20, 25, 30, 35, 40, 45, 50])
                ->icon('heroicon-o-exclamation-circle')
                ->color('danger'),
        ];
    }
    protected function getColumns(): int
    {
        return 3; // Cambia este número según cuántos widgets quieras en una fila
    }

}
