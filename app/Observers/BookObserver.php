<?php
namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Str;

class BookObserver
{
   private function generateUniqueSlug($title)
{
    $baseSlug = Str::slug($title);

    $existingSlugs = Book::where('slug', 'LIKE', $baseSlug . '%')
        ->pluck('slug')
        ->toArray();

    if (!in_array($baseSlug, $existingSlugs)) {
        return $baseSlug;
    }

    $i = 1;
    while (in_array($baseSlug . '-id' . $i, $existingSlugs)) {
        $i++;
    }

    return $baseSlug . '-id' . $i;
}


 

    public function updated(Book $book): void
    {
        $title = $book->translations->firstWhere('locale', 'en')->title;

        $slug = $this->generateUniqueSlug($title);

        Book::withoutEvents(function () use ($book, $slug) {
            $book->slug = $slug;
            $book->save();
        });
    }

    public function deleted(Book $book): void
    {
    }
    public function restored(Book $book): void
    {
    }
    public function forceDeleted(Book $book): void
    {
    }
}
