<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::view('dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth:sanctum');

Route::redirect('/', '/dashboard');
