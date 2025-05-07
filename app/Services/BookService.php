<?php

namespace App\Services;

use App\Models\Book;
use App\Interfaces\Services\BookServiceIntarface;

class BookService implements BookServiceIntarface
{
    /**
     * Create a new class instance.
     */

        public function index()
        {   
            $books = Book::with(['categories', 'images'])
            ->paginate(10);
            return $books;
            
        }
        public function show($slug)
        {
             $book = Book::with([
            'categories',
            'images',
            
        ])->where('slug', $slug)->firstOrFail();
    
        }
        public function search($request)
        {
            // Logic for search
        }
        public function store($data)
        {
            // Logic for store
        }
        public function update($data)
        {
            // Logic for update
        }
        public function destroy($book)
        {
            // Logic for destroy
        }
    
}
