<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class, [
        'except' => ['show'],
    ]);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
