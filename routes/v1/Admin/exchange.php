<?php

use App\Http\Controllers\Api\V1\Admin\ExchangeRateController;

Route::middleware(['setLocale', 'auth:sanctum', 'checkStatus'])->group(function () {
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index']);
    Route::post('/exchange-rates', [ExchangeRateController::class, 'store']);
    Route::put('/exchange-rates/{id}', [ExchangeRateController::class, 'update']);
    Route::delete('/exchange-rates/{id}', [ExchangeRateController::class, 'destroy']);
});
