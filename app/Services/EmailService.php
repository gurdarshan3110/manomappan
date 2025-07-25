<?php

namespace App\Services;

use App\Mail\PaymentSuccessMail;
use App\Mail\PasswordMail;
use App\Mail\WelcomeMail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailService
{
    /**
     * Generate a random password
     */
    public static function generateRandomPassword(int $length = 10): string
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*';

        // Ensure password has at least one character from each category
        $password = '';
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $symbols[random_int(0, strlen($symbols) - 1)];

        // Fill the rest with random characters
        $allChars = $uppercase . $lowercase . $numbers . $symbols;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        // Shuffle the password
        return str_shuffle($password);
    }

    /**
     * Send welcome email to new user
     */
    public static function sendWelcomeEmail(User $user): void
    {
        Mail::to($user->email)->queue(new WelcomeMail($user));
    }

    /**
     * Send password email to user with generated password
     */
    public static function sendPasswordEmail(User $user, string $password = null): string
    {
        if (!$password) {
            $password = self::generateRandomPassword();
        }

        // Update user password
        $user->update([
            'password' => Hash::make($password)
        ]);

        // Send email
        Mail::to($user->email)->queue(new PasswordMail($user, $password));

        return $password;
    }

    /**
     * Send payment success email with PDF receipt
     */
    public static function sendPaymentSuccessEmail(User $user, Payment $payment): void
    {
        Mail::to($user->email)->queue(new PaymentSuccessMail($user, $payment));
    }

    /**
     * Create user with random password and send emails
     */
    public static function createUserWithPassword(array $userData): array
    {
        $password = self::generateRandomPassword();
        
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        // Send welcome email
        self::sendWelcomeEmail($user);

        // Send password email
        self::sendPasswordEmail($user, $password);

        return [
            'user' => $user,
            'password' => $password
        ];
    }

    /**
     * Send password reset email (generate new password)
     */
    public static function sendPasswordResetEmail(User $user): string
    {
        return self::sendPasswordEmail($user);
    }
}
