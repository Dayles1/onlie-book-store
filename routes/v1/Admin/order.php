<?php

// use App\Http\Controllers\v1\Admin\OrderController;
Route::middleware(['auth:sanctum', 'setLocale'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

});