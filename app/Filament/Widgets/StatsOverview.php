<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Package;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Users', User::isActive()->count())
                ->description('Users with active status')
                ->descriptionIcon('heroicon-m-user')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Inactive Users', User::isInactive()->count())
                ->description('Users with inactive status')
                ->descriptionIcon('heroicon-m-user-minus')
                ->color('danger')
                ->chart([3, 2, 1, 2, 1, 1, 2]),

            Stat::make('Total Packages', Package::count())
                ->description('Available service packages')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([2, 3, 4, 3, 4, 5, 4]),
        ];
    }
}
