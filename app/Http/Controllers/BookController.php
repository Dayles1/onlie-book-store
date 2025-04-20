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
        $book->fill($translations);
        $book->save();
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
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return $this->error(__('messages.book_not_found'), 404);
        }
        $book->update([
            'author'=>$request->author,
            'price'=>$request->price,
        ]);
        foreach ($request->categories as $category) {
            $book->categories()->attach($category);
        }
        $translations=$this->prepareTranslations($request->translations, ['title', 'description']);
        $book->fill($translations);
        $book->save();

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
        return $this->success(new BookResource($book), __('messages.book_update_success'), 200);
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return $this->error(__('messages.book_not_found'), 404);
        }
        $images = $book->images;
        foreach ($images as $image) {
            $this->deletePhoto($image->path);
        }
        $book->delete();
        return $this->success(null, __('messages.book_delete_success'), 200);
    }
}
