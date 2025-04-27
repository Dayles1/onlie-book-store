<?php 

use App\Http\Controllers\Api\V1\Admin\BookController;
Route::middleware(['setLocale','auth:sanctum','checkRole'])->group(function () {
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{slug}', [BookController::class, 'destroy'])->name('books.destroy');
});


