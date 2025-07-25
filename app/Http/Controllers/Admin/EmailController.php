<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Send welcome email to user
     */
    public function sendWelcomeEmail(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        
        EmailService::sendWelcomeEmail($user);
        
        return response()->json([
            'success' => true,
            'message' => 'Welcome email sent successfully to ' . $user->email
        ]);
    }

    /**
     * Send password reset email (generate new password)
     */
    public function sendPasswordResetEmail(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        
        $password = EmailService::sendPasswordResetEmail($user);
        
        return response()->json([
            'success' => true,
            'message' => 'Password reset email sent successfully to ' . $user->email,
            'password' => $password // For admin reference only
        ]);
    }

    /**
     * Create user with random password
     */
    public function createUserWithPassword(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $result = EmailService::createUserWithPassword([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully with auto-generated password',
            'user' => $result['user'],
            'password' => $result['password'] // For admin reference only
        ]);
    }
}
