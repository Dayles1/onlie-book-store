<?php

Route::middleware(['setLocale','auth:sanctum','checkStatus'])->group(function () {
    Route::get('/notifications', 'Admin\NotificationController@index');
    Route::get('/notifications/unread', 'Admin\NotificationController@unread');
    Route::get('/notifications/readed', 'Admin\NotificationController@readed');
});