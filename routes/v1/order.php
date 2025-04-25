<?php 

use App\Models\Order;
use App\Http\Controllers\OrderController;
Route::middleware(['setLocale','auth:sanctum','checkStatus'])->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
});
Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
});