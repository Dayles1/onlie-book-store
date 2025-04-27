<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
//     // Admin
    require __DIR__ . '/v1/Admin/auth.php';
    require __DIR__ . '/v1/Admin/book.php';  
    require __DIR__ . '/v1/Admin/category.php';

    require __DIR__ . '/v1/Admin/language.php'; 
    require __DIR__ . '/v1/Admin/notification.php'; 
    require __DIR__ . '/v1/Admin/translation.php'; 
    
    require __DIR__ . '/v1/Admin/user.php';  
    require __DIR__ . '/v1/Admin/user.php'; 
    require __DIR__ . '/v1/Admin/exchange.php'; 

    
//     //User

    require __DIR__ . '/v1/User/auth.php';
    require __DIR__ . '/v1/User/order.php';
    require __DIR__ . '/v1/User/book.php';

    require __DIR__ . '/v1/User/category.php';
    require __DIR__ . '/v1/User/language.php';
    require __DIR__ . '/v1/User/translation.php';
    

});
