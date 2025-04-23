<?php 

use App\Http\Controllers\LanguageController;
Route::middleware(['setLocale'])->group(function () {
Route::get('/langs', [LanguageController::class, 'index']);

});
// 'auth:sanctum'