<?php 

use App\Http\Controllers\Api\V1\Admin\OrderController;


Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::put('/orders/{id}', [OrderController::class, 'edit']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);


});