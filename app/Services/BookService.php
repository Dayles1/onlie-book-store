<?php

namespace App\Services;

use App\Models\Book;
use App\Interfaces\Services\BookServiceIntarface;

class BookService  extends BaseService implements  BookServiceIntarface
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
            return $book;
        }
        public function search($request)
        {
            $query = Book::query();
    
            if ($search = $request->input('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('author', 'like', "%{$search}%")
                      ->orWhere('title->uz', 'like', "%{$search}%")  // Uzbek title
                      ->orWhere('title->ru', 'like', "%{$search}%")  // Russian title
                      ->orWhere('description->uz', 'like', "%{$search}%")
                      ->orWhere('description->ru', 'like', "%{$search}%");
                });
            }
        
            if ($category = $request->input('category')) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('slug', $category)
                      ->orWhere('title->uz', 'like', "%{$category}%")
                      ->orWhere('title->ru', 'like', "%{$category}%");
                });
            }
        
            $books = $query->paginate(10);
            return $books;
        }
        public function store($data)
        {

        }
        public function update($data)
        {

        }
        public function destroy($book)
        {

        }
    
}
