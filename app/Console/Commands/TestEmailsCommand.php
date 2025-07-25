<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Console\Command;

class TestEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:test {type?} {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality with different templates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $userId = $this->option('user');

        // Get user for testing
        $user = $userId ? User::find($userId) : User::first();
        
        if (!$user) {
            $this->error('No user found to test with. Please create a user first.');
            return 1;
        }

        $this->info("Testing emails with user: {$user->email}");

        if (!$type) {
            $type = $this->choice('Which email type do you want to test?', [
                'welcome' => 'Welcome Email',
                'password' => 'Password Email',
                'payment' => 'Payment Success Email',
                'all' => 'All Email Types'
            ]);
        }

        switch ($type) {
            case 'welcome':
                $this->testWelcomeEmail($user);
                break;
            case 'password':
                $this->testPasswordEmail($user);
                break;
            case 'payment':
                $this->testPaymentEmail($user);
                break;
            case 'all':
                $this->testWelcomeEmail($user);
                $this->testPasswordEmail($user);
                $this->testPaymentEmail($user);
                break;
            default:
                $this->error('Invalid email type.');
                return 1;
        }

        $this->info('Email testing completed! Check your logs to see the rendered emails.');
        return 0;
    }

    private function testWelcomeEmail(User $user)
    {
        $this->info('Sending welcome email...');
        EmailService::sendWelcomeEmail($user);
        $this->line('✅ Welcome email queued');
    }

    private function testPasswordEmail(User $user)
    {
        $this->info('Sending password email...');
        $password = EmailService::sendPasswordResetEmail($user);
        $this->line("✅ Password email queued (Generated password: {$password})");
    }

    private function testPaymentEmail(User $user)
    {
        // Find a payment for this user, or create a mock one
        $payment = Payment::where('user_id', $user->id)->first();
        
        if (!$payment) {
            $this->warn('No payment found for this user. Skipping payment email test.');
            $this->line('To test payment emails, make a test payment first.');
            return;
        }

        $this->info('Sending payment success email...');
        EmailService::sendPaymentSuccessEmail($user, $payment);
        $this->line('✅ Payment success email queued');
    }
}
