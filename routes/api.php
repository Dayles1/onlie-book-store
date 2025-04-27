<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
//     // Admin
    require __DIR__ . '/v1/admin.php';
    

    
//     //User

    require __DIR__ . '/v1/user.php';
   
    

});
