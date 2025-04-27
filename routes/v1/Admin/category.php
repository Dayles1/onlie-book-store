<?php

use App\Http\Controllers\Api\V1\Admin\CategoryController;

Route::middleware(['setLocale','auth:sanctum','checkRole'])->group(function () {
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
}); 
