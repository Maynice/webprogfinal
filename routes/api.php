<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FormsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/me', [UserController::class, 'update']);
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index']);
    Route::get('/users/{userId}', [UserManagementController::class, 'user']);
    Route::post('/users', [UserManagementController::class, 'store']);
    Route::put('/users/{userId}', [UserManagementController::class, 'update']);
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy']);
});

Route::prefix('applicant')->middleware('auth:sanctum')->group(function () {
    Route::put('/apply', [FormsController::class, 'create']);
});
