<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AuthController;

Route::middleware('setLocale')->group(function () {
    Route::post('adminRegister', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/verify-email', [AuthController::class, 'verifyEmail']);
});
Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

});