<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Repositories\BookRepositoryInterface;

class BookRepository  implements BookRepositoryInterface
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
public function store($data,$translations){
     $book = new Book([
                'author' =>$data->author,
                'price'  => $data->price,
            ]);
    $book->saveQuietly();
    $book->setTranslations($translations);

    $book->categories()->attach($data->categories);
    sleep(1); 
    $book->touch(); 
            return $book;
    }
public function update($data,$translations, $book){
    $book->setTranslations($translations);
    $book->update([
        'author' => $data->author,
        'price'  => $data->price,
    ]);
    
    $book->categories()->sync($data->categories);
    return $book;
    }
    public function destroy($book){
       return  $book->delete();
    }
public function search(array $request)
{
    $query = Book::query();

    if (!empty($request['search'])) {
        $search = $request['search'];
        $query->where(function ($q) use ($search) {
            $q->where('author', 'like', "%{$search}%")
              ->orWhereHas('translations', function ($q) use ($search) {
                  $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
              });
        });
    }

    if (!empty($request['category'])) {
        $category = $request['category'];
        $query->whereHas('categories.translations', function ($q) use ($category) {
            $q->where('title', 'like', "%{$category}%")
              ->orWhere('slug', 'like', "%{$category}%");
        });
    }

    return $query;
}
public function findBySlug($slug){
        $book = Book::where('slug', $slug)->firstOrFail();
        return $book;
    }
public function insertImage( $images){
     return Image::insert($images);

}
public function destroyImage( $book){
   return $book->images()->delete();

    }

}
