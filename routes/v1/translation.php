<?php 

use App\Http\Controllers\Api\V1\Admin\TranslationController;
Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{id}', [TranslationController::class, 'update']);
    Route::delete('/translations/{id}', [TranslationController::class, 'destroy']);
    Route::get('/translations/{id}', [TranslationController::class, 'show']);

});
// 'auth:sanctum'