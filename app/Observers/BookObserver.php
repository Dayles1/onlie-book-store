<?php
namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Str;

class BookObserver
{
    private function generateUniqueSlug($title, $count = 0)
    {
        $slug = Str::slug($title);

        if ($count > 0) {
            $slug .= "-ID$count";
        }
        return $slug;
    }


    public function created(Book $book): void
    {
        $title = $book->translations->firstWhere('locale', 'en')->title; ;
        $slug = $this->generateUniqueSlug($title);
    
        Book::withoutEvents(function () use ($book, $slug) {
            $book->slug = $slug;
            $book->save();
        });
    }

    public function updated(Book $book): void
    {
        $title = $book->translations->firstWhere('locale', 'en')->title; ;

        $slug = $this->generateUniqueSlug($title);
    
        Book::withoutEvents(function () use ($book, $slug) {
            $book->slug = $slug;
            $book->save();
        });
    }

    public function deleted(Book $book): void {}
    public function restored(Book $book): void {}
    public function forceDeleted(Book $book): void {}
}
