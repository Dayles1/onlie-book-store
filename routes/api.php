<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    require __DIR__ . '/v1/auth.php';
    require __DIR__ . '/v1/user.php';
    require __DIR__ . '/v1/category.php';
    require __DIR__ . '/v1/book.php';
    require __DIR__ . '/v1/language.php';
    require __DIR__ . '/v1/translation.php';
    require __DIR__ . '/v1/like.php';
    require __DIR__ . '/v1/order.php';
    require __DIR__ . '/v1/notification.php';    

});
