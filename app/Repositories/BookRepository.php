<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Repositories\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
  public function index(){
                $books = Book::with(['categories', 'images'])
            ->paginate(10);
            return $books;
  }
    public function show($slug){
        $book = Book::with([
            'categories',
            'images',
        ])->where('slug', $slug)->firstOrFail();
        return $book;
    }
    public function store($request){
          $book = new Book([
                'author' =>$request['author'],
                'price'  => $request['price'],
            ]);
            $translations = $this->prepareTranslations($request['translations'], ['title', 'description']);
            $book->fill($translations);
            $book->save();
            $book->categories()->attach($request['categories']);
            $images = [];
            if ($request['images']) {
                foreach ($request['images'] as $image) {
                    $images[] = [
                        'path' => $this->uploadPhoto($image, 'products'),
                        'imageable_id' => $book->id,
                        'imageable_type' => Book::class,
                    ];
                }
                Image::insert($images);
            }
        
            return $book;
    }
    public function update($request, $slug){
        $book = Book::where('slug', $slug)->firstOrFail();

    $book->author = $request['author'];
    $book->price  = $request['price'];
    $book->categories()->sync($request['categories']);
    $translations = $this->prepareTranslations($request['translations'], ['title', 'description']);
    $book->fill($translations)->save();
    foreach ($book->images as $image) {
        $this->deletePhoto($image->path);
    }
    $book->images()->delete();
    $images = [];
    if ($request['images']) {
        foreach ($request['images'] as $image) {
            $images[] = [
                'path' => $this->uploadPhoto($image, "products"),
                'imageable_id' => $book->id,
                'imageable_type' => Book::class,
            ];
        }
        Image::insert($images);
    }

    return $book;
    }
    public function destroy($slug){
         $book   = Book::where('slug', $slug)->firstOrFail();
        //  dd($book->images());
             foreach ($book->images as $image) {
                $this->deletePhoto($image->path);
              }

        $book->delete();
    }
   
}
