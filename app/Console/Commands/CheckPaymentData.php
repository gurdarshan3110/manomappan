<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\UserHasPackage;
use Illuminate\Console\Command;

class CheckPaymentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:check {--user-id= : Check payments for specific user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payment data and user packages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id');

        $this->info('Payment System Status Check');
        $this->info('========================');

        // Payment statistics
        $totalPayments = Payment::count();
        $successfulPayments = Payment::successful()->count();
        $totalRevenue = Payment::successful()->sum('amount');

        $this->table(['Metric', 'Value'], [
            ['Total Payments', $totalPayments],
            ['Successful Payments', $successfulPayments],
            ['Total Revenue', '₹ ' . number_format($totalRevenue, 2)],
        ]);

        // User package statistics
        $totalUserPackages = UserHasPackage::count();
        $activeUserPackages = UserHasPackage::active()->count();

        $this->table(['User Package Metric', 'Value'], [
            ['Total User Packages', $totalUserPackages],
            ['Active User Packages', $activeUserPackages],
        ]);

        // Recent payments
        $this->info('Recent Payments:');
        $recentPayments = Payment::with(['user', 'package'])
            ->latest()
            ->limit(5)
            ->get();

        if ($recentPayments->count() > 0) {
            $this->table(
                ['Payment ID', 'User', 'Package', 'Amount', 'Status', 'Date'],
                $recentPayments->map(function ($payment) {
                    return [
                        $payment->payment_id,
                        $payment->user->name ?? 'N/A',
                        $payment->package->plan_name ?? 'N/A',
                        '₹ ' . number_format($payment->amount, 2),
                        $payment->status,
                        $payment->created_at->format('Y-m-d H:i:s')
                    ];
                })
            );
        } else {
            $this->warn('No payments found.');
        }

        // User-specific check
        if ($userId) {
            $this->info("Checking data for User ID: $userId");
            
            $userPayments = Payment::where('user_id', $userId)->with('package')->get();
            $userPackages = UserHasPackage::where('user_id', $userId)
                ->with(['package', 'payment'])
                ->get();

            if ($userPayments->count() > 0) {
                $this->info('User Payments:');
                $this->table(
                    ['Payment ID', 'Package', 'Amount', 'Status', 'Date'],
                    $userPayments->map(function ($payment) {
                        return [
                            $payment->payment_id,
                            $payment->package->plan_name ?? 'N/A',
                            '₹ ' . number_format($payment->amount, 2),
                            $payment->status,
                            $payment->created_at->format('Y-m-d H:i:s')
                        ];
                    })
                );
            }

            if ($userPackages->count() > 0) {
                $this->info('User Active Packages:');
                $this->table(
                    ['Package', 'Activated', 'Status', 'Payment ID'],
                    $userPackages->map(function ($userPackage) {
                        return [
                            $userPackage->package->plan_name ?? 'N/A',
                            $userPackage->activated_at->format('Y-m-d H:i:s'),
                            $userPackage->is_active ? 'Active' : 'Inactive',
                            $userPackage->payment->payment_id ?? 'N/A'
                        ];
                    })
                );
            }
        }
    }
}
