<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\CategoryController;
use App\Http\Controllers\Api\V1\User\LanguageController;
use App\Http\Controllers\Api\V1\User\LikeController;
use App\Http\Controllers\Api\V1\User\OrderController;
use App\Http\Controllers\Api\V1\User\TranslationController;
use App\Http\Controllers\Api\V1\User\AuthController;
use App\Http\Controllers\Api\V1\User\BookController;

       

Route::middleware('setLocale')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/verify-email', [AuthController::class, 'verifyEmail']);


    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{slug}', [BookController::class, 'show'])->name('books.show');
    Route::post('books/search', [BookController::class, 'search']);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/langs', [LanguageController::class, 'index']);
    Route::get('/langs/{id}', [LanguageController::class, 'show']);
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::get('/translations/{id}', [TranslationController::class, 'show']);

});


Route::middleware(['setLocale','auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/wishlist', [LikeController::class,'index']);
    Route::post('/like/{bookId}', [LikeController::class,'likeDislike']);
    
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

});




