<?php 

use App\Http\Controllers\Api\V1\User\TranslationController;

Route::middleware(['setLocale',])->group(function () {
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::get('/translations/{id}', [TranslationController::class, 'show']);

});