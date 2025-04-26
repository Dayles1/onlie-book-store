<?php 

use App\Http\Controllers\Api\V1\Admin\LanguageController;

Route::middleware(['setLocale','auth:sanctum','checkStatus'])->group(function () {
Route::post('/langs', [LanguageController::class, 'store']);
Route::put('/langs/{id}', [LanguageController::class, 'update']);
Route::delete('/langs/{id}', [LanguageController::class, 'destroy']);

});