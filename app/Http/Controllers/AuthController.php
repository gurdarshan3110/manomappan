<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'user_type' => User::USER_TYPE_USER,
            'status' => User::STATUS_ACTIVE,
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'Registration failed, please try again.');
        }

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registration successful!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('user.dashboard');
            } else {
                $names = explode(' ', $user->name);
                $firstName = $names[0];
                $lastName = isset($names[1]) ? $names[1] : '';

                $newUser = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar,
                    'user_type' => User::USER_TYPE_USER,
                    'status' => User::STATUS_ACTIVE,
                    'password' => encrypt(rand(1, 10000)),
                ]);

                Auth::login($newUser);
                return redirect()->route('user.dashboard');
            }
        } catch (Exception $e) {
            return redirect()->route('pages.login')->with('error', 'Something went wrong!');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->user_type === User::USER_TYPE_USER) {
                return redirect()->intended(route('user.dashboard'));
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have permission to access this area.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
