<?php
namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Str;

class BookObserver
{
    public function created(Book $book): void
    {
        $title = $book->getRelation('translations_cache')
    ->first(function ($item) {
        return isset($item['en']['title']);
    })['en']['title'] ;

    $slug = Str::slug($title) . '-ID' . time();
    
        Book::withoutEvents(function () use ($book, $slug) {
            $book->slug = $slug;
            $book->save();
        });
    }

    public function updated(Book $book): void
    {
        $slug = Str::slug($book->original_title) . '-ID' . time();

        if ($book->slug !== $slug) {
            Book::withoutEvents(function () use ($book, $slug) {
                $book->slug = $slug;
                $book->save();
            });
        }
    }

    public function deleted(Book $book): void {}
    public function restored(Book $book): void {}
    public function forceDeleted(Book $book): void {}
}
