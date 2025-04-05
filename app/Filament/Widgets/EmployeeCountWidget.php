<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', Employee::count())
                ->icon('heroicon-o-users')
                ->description('All employees in the system')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
