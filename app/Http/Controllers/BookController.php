<?php

namespace App\Http\Controllers;

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

        
        if ($request->has('categories')) {
            $book->categories()->attach($request->input('categories'));
        }

        return response()->json(['message' => __('message.book.create_success'), 'book' => $book], 201);
    }
}
