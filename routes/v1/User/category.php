<?php

use App\Http\Controllers\Api\V1\User\CategoryController;
Route::middleware(['setLocale',])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
});