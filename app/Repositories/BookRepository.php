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
    public function store($request,$book,$images){
            $book->save();
            $book->categories()->attach($request['categories']);
            Image::insert($images);
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
                      foreach ($book->images as $image) {
                $this->deletePhoto($image->path);
              }

        $book->delete();
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

}
