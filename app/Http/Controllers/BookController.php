<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    public function store(BookStoreRequest $request)
    {
        
        $book = Book::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'author'=>$request->author,
            'price'=>$request->price,
            
        ]);
        foreach ($request->categories as $category) {
            $book->categories()->attach($category);
        }
        return $this->success($book, __('messages.book_created'), 201);

    }
}
