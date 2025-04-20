<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
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

        return $this->success(new BookResource($book->load(['images','categories'])), __('messages.book_created'), 201);

    }
    public function show($id)
    {
        $book = Book::with(['images', 'categories','orders','likes'])->find($id);
        if (!$book) {
            return $this->error(__('messages.book_not_found'), 404);
        }
        return $this->success(new BookResource($book->load), __('messages.book_show_success'), 200);
    }
}
