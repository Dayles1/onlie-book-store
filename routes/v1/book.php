<?php 

use App\Http\Controllers\BookController;
Route::middleware(['setLocale','auth:sanctum'])->group(function () {
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});
Route::get('/books', [BookController::class, 'index']);
Route::get('books/{slug}', [BookController::class, 'show']);
// 'auth:sanctum'