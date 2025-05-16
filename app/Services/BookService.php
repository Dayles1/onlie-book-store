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
            $query=$this->BookRepository->search($request);
           
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
            $book=$this->BookRepository->destroy($slug);
        }
    
}
