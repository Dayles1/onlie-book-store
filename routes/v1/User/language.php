<?php 

use App\Http\Controllers\Api\V1\User\LanguageController;




Route::middleware(['setLocale',])->group(function () {
Route::get('/langs', [LanguageController::class, 'index']);

});