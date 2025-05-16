<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Repositories\BookRepositoryInterface;

class BookService  extends BaseService implements  BookServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected BookRepositoryInterface $BookRepository){}


        public function index()
        {   
            $books=$this->BookRepository->index();
            return $books;
        }
        public function show($slug)
        {
            $book=$this->BookRepository->show($slug);
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
            $book = $this->BookRepository->store($request);
            return $book;
        }
        
        public function update($request, $slug)
    {
        $book=$this->BookRepository->update($request, $slug);  
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
