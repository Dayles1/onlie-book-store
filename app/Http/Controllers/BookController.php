<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);
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
