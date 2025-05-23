<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('Welcome to Laravel 11 API');
})->name('welcome');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/task', [TaskController::class, 'listPublic']);

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
        Route::get('/user/task', 'listPrivate');
        Route::get('/user/task/{id}', 'show');
        Route::post('/user/task', 'create');
        Route::put('/user/task/{id}', 'update');
        Route::delete('/user/task/{id}', 'delete');
    });
});
