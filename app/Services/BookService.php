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
             $book = new Book([
                'author' =>$request['author'],
                'price'  => $request['price'],
            ]);
            $translations = $this->prepareTranslations($request['translations'], ['title', 'description']);
            $book->fill($translations);
            $book = $this->BookRepository->store($request,$book);

            $images = [];
                        if ($request['images']) {
                foreach ($request['images'] as $image) {
                    $images[] = [
                        'path' => $this->uploadPhoto($image, 'products'),
                        'imageable_id' => $book->id,
                        'imageable_type' => Book::class,
                    ];
                }
                $image=$this->BookRepository->updatePhoto( $images);
            }
            return $book;
        }
        public function update($request, $slug)
        {
            $book = $this->BookRepository->findBySlug($slug);
            $book->author = $request['author'];
            $book->price  = $request['price'];
            $translations = $this->prepareTranslations($request['translations'], ['title', 'description']);
            $book->fill($translations);

            $book=$this->BookRepository->update($request, $book);  

             if ($request->has('images')){
              $images = [];
                foreach ($request['images'] as $image) {
                       $images[] = [
                'path' => $this->uploadPhoto($image, "products"),
                'imageable_id' => $book->id,
                'imageable_type' => Book::class,
                ];}
             foreach ($book->images as $image) {
                 $this->deletePhoto($image->path);
            }
            }
         return $book;
        }
        public function destroy($slug)
        {
            $book = $this->BookRepository->findBySlug($slug);

                      foreach ($book->images as $image) {
                $this->deletePhoto($image->path);
              }
            $book=$this->BookRepository->destroy($book);
        }
    
}
