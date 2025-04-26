<?php 

use App\Http\Controllers\Api\V1\Admin\LanguageController;

Route::middleware(['setLocale','auth:sanctum'])->group(function () {
Route::get('/langs', [LanguageController::class, 'index']);

});