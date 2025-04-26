<?php 

use App\Models\Order;
use App\Http\Controllers\OrderController;

Route::middleware(['setLocale','auth:sanctum'])->group(function () {
});