<?php

namespace App\Repositories;

use App\Models\Book;
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
    public function store($data){}
    public function update($data, $slug){}
    public function destroy(){}
   
}
