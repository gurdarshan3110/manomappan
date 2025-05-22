<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::name('pages.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::get('/register', [PageController::class, 'register'])->name('register');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});