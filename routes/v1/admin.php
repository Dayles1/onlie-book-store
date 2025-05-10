<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AuthController;
use App\Http\Controllers\Api\V1\Admin\BookController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Admin\OrderController;
use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Admin\LanguageController;
use App\Http\Controllers\Api\V1\Admin\TranslationController;
use App\Http\Controllers\Api\V1\Admin\ExchangeRateController;
use App\Http\Controllers\Api\V1\Admin\NotificationController;





Route::middleware(['setLocale','auth:sanctum','checkRole'])->group(function () {
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{slug}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/exchange-rates', [ExchangeRateController::class, 'index']);
    Route::post('/exchange-rates', [ExchangeRateController::class, 'store']);
    Route::put('/exchange-rates/{id}', [ExchangeRateController::class, 'update']);
    Route::delete('/exchange-rates/{id}', [ExchangeRateController::class, 'destroy']);

    Route::post('/langs', [LanguageController::class, 'store']);
    Route::put('/langs/{id}', [LanguageController::class, 'update']);
    Route::delete('/langs/{id}', [LanguageController::class, 'destroy']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('notification.unread');
    Route::get('/notifications/readed', [NotificationController::class, 'readed'])->name('notification.readed');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notification.show');

    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{id}', [TranslationController::class, 'update']);
    Route::delete('/translations/{id}', [TranslationController::class, 'destroy']);

    Route::get('/user/list', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    

});

Route::middleware(['setLocale','auth:sanctum'])->group(function () {


    Route::put('/orders/{id}', [OrderController::class, 'update']);


});