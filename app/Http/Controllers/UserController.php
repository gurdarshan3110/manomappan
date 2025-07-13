<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $meta = config('metatags.dashboard');
        $user = Auth::user();

        return view('user.dashboard', compact('meta', 'user'));
    }

    public function profile()
    {
        $meta = config('metatags.user_profile');
        $user = Auth::user();

        return view('user.profile', compact('meta', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
        ]);
        /** @var \App\Models\User $user */
        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();


        $user->update([
            'password' => bcrypt($validated['password'])
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
