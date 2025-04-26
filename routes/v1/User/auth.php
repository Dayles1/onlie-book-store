<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\AuthController;

Route::middleware('setLocale')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/verify-email', [AuthController::class, 'verifyEmail']);
});