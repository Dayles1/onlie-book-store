<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
   private function generateUniqueSlug($title)
{
    $baseSlug = Str::slug($title);

    $existingSlugs = Category::where('slug', 'LIKE', $baseSlug . '%')
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

   
  

    /**
     * Handle the Category "updated" event.
     */

    public function updated(Category $category): void
    {       
        $title = $category->translations->firstWhere('locale', 'en')->title; ;
        $slug = $this->generateUniqueSlug($title);
    
        Category::withoutEvents(function () use ($category, $slug) {
            $category->slug = $slug;
            $category->save();
        });
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
