<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

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

    // Google Login
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
});