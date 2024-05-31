<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'show');
        Route::put('/user', 'update');
        Route::delete('/user', 'delete');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
});
