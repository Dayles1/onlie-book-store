<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Services\BookServiceInterface;

class BookService  extends BaseService implements  BookServiceInterface
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
                      ->orWhereHas('translations', function ($q) use ($search) {
                          $q->where('title', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                      });
                });
            }
        
            if ($category = $request->input('category')) {
                $query->whereHas('categories.translations', function ($q) use ($category) {
                    $q->where('title', 'like', "%{$category}%")
                      ->orWhere('slug', 'like', "%{$category}%");
                });
            }
        
            return $query->with(['categories', 'images'])->paginate(10);
        }
        
        public function store($request)
        {
            $book = new Book([
                'author' => $request->input('author'),
                'price'  => $request->input('price'),
            ]);
        
            $translations = $this->prepareTranslations($request->input('translations'), ['title', 'description']);
            $book->fill($translations);
            $book->save();
        
            $book->categories()->attach($request->input('categories'));
        
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
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
        
        public function update($request, $slug)
{
    $book = Book::where('slug', $slug)->firstOrFail();

    $book->author = $request->input('author');
    $book->price  = $request->input('price');

    $book->categories()->sync($request->input('categories'));

    $translations = $this->prepareTranslations($request->input('translations'), ['title', 'description']);
    $book->fill($translations)->save();
    
    foreach ($book->images as $image) {
        $this->deletePhoto($image->path);
    }
    $book->images()->delete();
    
    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
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

        public function destroy($slug)
        {
        $book   = Book::where('slug', $slug)->firstOrFail();
             foreach ($book->images as $image) {
                $this->deletePhoto($image->path);
              }

        $book->delete();
        return ['status'=>'success'];

        }
    
}
