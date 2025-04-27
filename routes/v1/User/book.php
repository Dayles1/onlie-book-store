<?php 

use App\Http\Controllers\Api\V1\User\BookController;


Route::middleware(['setLocale',])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{slug}', [BookController::class, 'show'])->name('books.show');
    Route::get('books/search', [BookController::class, 'search']);

});

