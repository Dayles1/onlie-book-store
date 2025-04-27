<?php
Route::middleware(['setLocale','auth:sanctum','checkRole'])->group(function () {
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});