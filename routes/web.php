<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('pages.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::get('/register', [PageController::class, 'register'])->name('register');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/forgot-password', [PageController::class, 'forgotPassword'])->name('forgot_password');
    Route::get('/payment', [PageController::class, 'payment'])->name('payment');
});

Route::name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Google Login
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
});

Route::name('user.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    // Add more authenticated routes here
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('update-password');
});