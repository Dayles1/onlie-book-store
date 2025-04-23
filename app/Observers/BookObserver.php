<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\BookTranslation;
use Illuminate\Support\Str;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    private function generateUniqueSlug($title, $count = 0)
    {
        $slug = Str::slug($title);

        if ($count > 0) {
            $slug .= "-ID$count";
        }

        if (Book::where('slug', $slug)->exists()) {
            return $this->generateUniqueSlug($title, $count + 1);
        }

        return $slug;
    }
    public function created(Book $book): void
{
        $title = $book->translations->where('locale', 'en')->first()->title;
        $slug = $this->generateUniqueSlug($title);
        $book->slug = $slug;
        $book->save();
}


    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        if ($book->isDirty('title')) {
            $slug = $this->generateUniqueSlug($book->title);
            $book->slug = $slug;
            $book->save();
        }
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
