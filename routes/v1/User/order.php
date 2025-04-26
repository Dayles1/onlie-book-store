<?php 

use App\Http\Controllers\Api\V1\User\OrderController;

Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

});