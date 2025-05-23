<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Image;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Repositories\BookRepositoryInterface;

class BookService  extends BaseService implements  BookServiceInterface
{
    
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
        public function store($data)
        {
            $translations = $this->prepareTranslations($data->translations, ['title', 'description']);
            $book = $this->BookRepository->store($data,$translations);
            $images = [];
                        if ($data->images) {
                foreach ($data->images as $image) {
                    $images[] = [
                        'path' => $this->uploadPhoto($image, 'products'),
                        'imageable_id' => $book->id,
                        'imageable_type' => Book::class,
                    ];
                }
                $image=$this->BookRepository->insertImage( $images);
            }
            return $book;
        }
        public function update($data, $slug)
        {
            $book = $this->BookRepository->findBySlug($slug);
            $translations = $this->prepareTranslations($data->translations, ['title', 'description']);
             $book=$this->BookRepository->update($data, $translations,$book);  

             if ($data->images) {
                foreach ($book->images as $image) {
                 $this->deletePhoto($image->path);
            }
                $deleteImages = $this->BookRepository->destroyImage($book);

              $images = [];

                foreach ($data->images as $image) {
                       $images[] = [
                'path' => $this->uploadPhoto($image, "products"),
                'imageable_id' => $book->id,
                'imageable_type' => Book::class,
                ];}
            $image=$this->BookRepository->insertImage($images);
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
