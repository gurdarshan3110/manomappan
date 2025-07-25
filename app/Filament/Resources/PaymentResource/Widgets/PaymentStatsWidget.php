<?php

namespace App\Filament\Resources\PaymentResource\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PaymentStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Get today's date
        $today = now()->startOfDay();
        
        // Total successful payments
        $totalSuccessful = Payment::successful()->count();
        $totalSuccessfulAmount = Payment::successful()->sum('amount');
        
        // Total failed payments
        $totalFailed = Payment::failed()->count();
        
        // Today's successful payments
        $todaySuccessful = Payment::successful()
            ->whereDate('created_at', $today)
            ->count();
        $todaySuccessfulAmount = Payment::successful()
            ->whereDate('created_at', $today)
            ->sum('amount');
        
        // Today's failed payments
        $todayFailed = Payment::failed()
            ->whereDate('created_at', $today)
            ->count();
        
        // Yesterday's successful payments for comparison
        $yesterdaySuccessful = Payment::successful()
            ->whereDate('created_at', $today->copy()->subDay())
            ->count();
        $yesterdaySuccessfulAmount = Payment::successful()
            ->whereDate('created_at', $today->copy()->subDay())
            ->sum('amount');
        
        // Calculate trends
        $successfulTrend = $yesterdaySuccessful > 0 
            ? (($todaySuccessful - $yesterdaySuccessful) / $yesterdaySuccessful) * 100 
            : ($todaySuccessful > 0 ? 100 : 0);
        
        $amountTrend = $yesterdaySuccessfulAmount > 0 
            ? (($todaySuccessfulAmount - $yesterdaySuccessfulAmount) / $yesterdaySuccessfulAmount) * 100 
            : ($todaySuccessfulAmount > 0 ? 100 : 0);

        return [
            Stat::make('Total Successful Payments', $totalSuccessful)
                ->description('₹' . number_format($totalSuccessfulAmount, 2) . ' total revenue')
                ->descriptionIcon('heroicon-m-currency-rupee')
                ->color('success'),
            
            Stat::make('Total Failed Payments', $totalFailed)
                ->description('All time failed transactions')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            
            Stat::make("Today's Successful Payments", $todaySuccessful)
                ->description('₹' . number_format($todaySuccessfulAmount, 2) . ' revenue today')
                ->descriptionIcon($successfulTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($successfulTrend >= 0 ? 'success' : 'danger')
                ->chart($this->getSuccessfulPaymentChart()),
            
            Stat::make("Today's Failed Payments", $todayFailed)
                ->description('Failed transactions today')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($todayFailed > 0 ? 'warning' : 'success'),
        ];
    }
    
    /**
     * Get chart data for successful payments over the last 7 days
     */
    private function getSuccessfulPaymentChart(): array
    {
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->startOfDay();
            $count = Payment::successful()
                ->whereDate('created_at', $date)
                ->count();
            $data[] = $count;
        }
        
        return $data;
    }
}
