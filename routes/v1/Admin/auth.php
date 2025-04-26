<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AuthController;

Route::middleware('setLocale')->group(function () {
    Route::post('admin/register', [AuthController::class, 'adminRegister']);
});
