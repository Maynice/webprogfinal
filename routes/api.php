<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ReportController;

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
    Route::get('/users/reviewer', [UserManagementController::class, 'reviewer']);
    Route::get('/users/{userId}', [UserManagementController::class, 'user']);
    Route::post('/users', [UserManagementController::class, 'store']);
    Route::put('/users/{userId}', [UserManagementController::class, 'update']);
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy']);
    Route::get('/report', [ReportController::class, 'generate_report']);
});

Route::prefix('applicant')->middleware('auth:sanctum')->group(function () {
    Route::post('/apply', [FormsController::class, 'create']);
});

Route::prefix('form')->middleware('auth:sanctum')->group(function () {
    Route::get('/{form_id}', [FormsController::class, 'get']);
});

Route::prefix('submissions')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [SubmissionController::class, 'get']);
    Route::get('/applicant', [SubmissionController::class, 'applicant']);
    Route::get('/reviewer', [SubmissionController::class, 'reviewer']);
    Route::post('/update/{id}', [SubmissionController::class, 'update']);
    Route::post('/assign', [SubmissionController::class, 'assign']);
    Route::get('/admin/request/{submission_id}', [SubmissionController::class, 'admin_get_request']);
    Route::get('/reviewer/request/{submission_id}', [SubmissionController::class, 'reviewer_get_request']);
    Route::post('/reviewer/request', [SubmissionController::class, 'create_request']);
    Route::get('/applicant/request/{submission_id}', [SubmissionController::class, 'applicant_get_request']);
    Route::post('/applicant/request/{request_id}', [SubmissionController::class, 'applicant_upload_request']);
    Route::get('/applicant/request/{request_id}', [SubmissionController::class, 'applicant_get_single_request']);
});
