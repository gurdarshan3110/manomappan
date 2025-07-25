<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;

class TestEmailController extends Controller
{
    /**
     * Test email functionality (for development only)
     */
    public function testEmails()
    {
        if (config('app.env') !== 'local') {
            abort(404);
        }

        $user = User::first();
        
        if (!$user) {
            return response()->json(['error' => 'No users found to test with']);
        }

        // Test welcome email
        EmailService::sendWelcomeEmail($user);

        return response()->json([
            'success' => true,
            'message' => 'Test emails queued successfully',
            'user' => $user->email,
            'queue_connection' => config('queue.default')
        ]);
    }

    /**
     * Test password email
     */
    public function testPasswordEmail()
    {
        if (config('app.env') !== 'local') {
            abort(404);
        }

        $user = User::first();
        
        if (!$user) {
            return response()->json(['error' => 'No users found to test with']);
        }

        $password = EmailService::generateRandomPassword();

        return response()->json([
            'success' => true,
            'generated_password' => $password,
            'user' => $user->email
        ]);
    }
}
