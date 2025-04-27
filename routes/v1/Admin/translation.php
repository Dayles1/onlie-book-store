<?php 

use App\Http\Controllers\Api\V1\Admin\TranslationController;

Route::middleware(['setLocale','auth:sanctum','checkRole'])->group(function () {
    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{id}', [TranslationController::class, 'update']);
    Route::delete('/translations/{id}', [TranslationController::class, 'destroy']);

});