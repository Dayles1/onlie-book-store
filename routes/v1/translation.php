<?php 

use App\Http\Controllers\TranslationController;
Route::middleware(['setLocale'])->group(function () {
    Route::get('/translations', [TranslationController::class, 'index']);

});
// 'auth:sanctum'