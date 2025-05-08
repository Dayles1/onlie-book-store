<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Services\BookServiceIntarface;

class BookService  extends BaseService implements  BookServiceIntarface
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
                      ->orWhere('title->uz', 'like', "%{$search}%")  
                      ->orWhere('title->ru', 'like', "%{$search}%")  
                      ->orWhere('description->uz', 'like', "%{$search}%")
                      ->orWhere('description->ru', 'like', "%{$search}%");
                });
            }
        
            if ($category = $request->input('category')) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('slug', $category)
                      ->orWhere('title->uz', 'like', "%{$category}%")
                      ->orWhere('title->ru', 'like', "%{$category}%");
                });
            }
        
            $books = $query->paginate(10);
            return $books;
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
