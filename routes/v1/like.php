<?php

use App\Http\Controllers\Api\V1\User\LikeController;
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/like', [LikeController::class,'index']);
    Route::post('/like/{bookId}', [LikeController::class,'LikeDeathlike']);
});