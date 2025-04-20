<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    public function store(BookStoreRequest $request)
    {
        
        $book = Book::create([
            'author'=>$request->author,
            'price'=>$request->price,
        ]);
        foreach ($request->categories as $category) {
            $book->categories()->attach($category);
        }
        $translations=$this->prepareTranslations($request->translations, ['title', 'description']);
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = [
                    'path' => $this->uploadPhoto($image, "products"),
                    'imageable_id' => $book->id,
                    'imageable_type' => Book::class,
                ];
            }
        }
        Image::insert($images);

        return $this->success($book, __('messages.book_created'), 201);

    }
}
