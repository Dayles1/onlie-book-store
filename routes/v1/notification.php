<?php

use App\Http\Controllers\Admin\NotificationController;

Route::middleware(['setLocale','auth:sanctum','checkStatus'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('notification.unread');
    Route::get('/notifications/readed', [NotificationController::class, 'readed'])->name('notification.readed');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notification.show');
   
});