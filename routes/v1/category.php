<?php

Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
}); 
Route::middleware(['setLocale'])->group(function () {
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
});