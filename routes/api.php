<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('Welcome do Laravel 11 API');
})->name('welcome');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'show');
        Route::put('/user', 'update');
        Route::delete('/user', 'delete');
    });

    Route::controller(TaskController::class)->group(function () {
        Route::get('/task', 'list');
        Route::get('/task/{id}', 'show');
        Route::post('/task', 'create');
        Route::put('/task/{id}', 'update');
        Route::delete('/task/{id}', 'delete');
    });
});
