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
        public function store($data)
        {
            $book = new Book([
                'author' => $data['author'],
                'price'  => $data['price'],
            ]);
            
            $translations = $this->prepareTranslations($data['translations'], ['title', 'description']);
            $book->fill($translations);
            $book->save();
            
            $book->categories()->attach($data['categories']);
        
            $images = [];
            if ($data->hasFile('images')) {
                foreach ($data->file('images') as $image) {
                    $images[] = [
                        'path'            => $this->uploadPhoto($image, 'products'),
                        'imageable_id'    => $book->id,
                        'imageable_type'  => Book::class,
                    ];
                }
                Image::insert($images);
            }
            return $book;
        }
        public function update($data,$slug)
        {

            $book   = Book::where('slug', $slug)->firstOrFail();
        

        $book->author = $data['author'];
        $book->price  = $data['price'];

        $book->categories()->sync($data['categories']);

        $translations = $this->prepareTranslations($data['translations'], ['title', 'description']);
        $book->fill($translations)->save();

        $images = [];
        if ($data->hasFile('images')) {
            foreach ($data->file('images') as $image) {
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
