<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\User;
use App\Models\Package;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Payment statistics
        $totalSuccessfulPayments = Payment::successful()->count();
        $totalRevenue = Payment::successful()->sum('amount');
        $totalUsers = User::count();
        $totalPackages = Package::isActive()->count();
        
        // Today's statistics
        $todayPayments = Payment::successful()->whereDate('created_at', today())->count();
        $todayRevenue = Payment::successful()->whereDate('created_at', today())->sum('amount');
        $newUsersToday = User::whereDate('created_at', today())->count();
        
        // Yesterday's data for comparison
        $yesterdayPayments = Payment::successful()->whereDate('created_at', today()->subDay())->count();
        $yesterdayRevenue = Payment::successful()->whereDate('created_at', today()->subDay())->sum('amount');
        
        // Calculate trends
        $paymentTrend = $yesterdayPayments > 0 
            ? (($todayPayments - $yesterdayPayments) / $yesterdayPayments) * 100 
            : ($todayPayments > 0 ? 100 : 0);
            
        $revenueTrend = $yesterdayRevenue > 0 
            ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100 
            : ($todayRevenue > 0 ? 100 : 0);

        return [
            Stat::make('Total Revenue', '₹' . number_format($totalRevenue, 2))
                ->description($totalSuccessfulPayments . ' successful payments')
                ->descriptionIcon('heroicon-m-currency-rupee')
                ->color('success')
                ->chart($this->getRevenueChart()),
            
            Stat::make('Total Users', number_format($totalUsers))
                ->description($newUsersToday . ' new users today')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            
            Stat::make('Today\'s Revenue', '₹' . number_format($todayRevenue, 2))
                ->description($todayPayments . ' payments today')
                ->descriptionIcon($revenueTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueTrend >= 0 ? 'success' : 'danger'),
            
            Stat::make('Active Packages', number_format($totalPackages))
                ->description('Available for purchase')
                ->descriptionIcon('heroicon-m-gift')
                ->color('warning'),
        ];
    }
    
    /**
     * Get revenue chart data for the last 7 days
     */
    private function getRevenueChart(): array
    {
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->startOfDay();
            $revenue = Payment::successful()
                ->whereDate('created_at', $date)
                ->sum('amount');
            $data[] = $revenue;
        }
        
        return $data;
    }
}
