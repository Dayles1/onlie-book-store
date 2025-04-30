<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    private function generateUniqueSlug($title)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $count = 1;
    
        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-ID' . $count;
            $count++;
        }
    
        return $slug;
    }
    public function created(Category $book): void
    {
        $title = $book->translations->firstWhere('locale', 'en')->title; ;

        $slug = $this->generateUniqueSlug($title);
    
        Category::withoutEvents(function () use ($book, $slug) {
            $book->slug = $slug;
            $book->save();
        });
    }
  

    /**
     * Handle the Category "updated" event.
     */
    protected static $alreadyUpdated = false;

    public function updated(Category $category): void
    {
        if (self::$alreadyUpdated) {
            return;
        }
    
        self::$alreadyUpdated = true;
    
        $category->slug = $category->slug . '-ID' . time();
        $category->save();
    
        self::$alreadyUpdated = false;
    }
    


    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
