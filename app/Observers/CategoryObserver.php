<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    private function generateUniqueSlug($title, $count = 0)
    {
        $slug = Str::slug($title);

        if ($count > 0) {
            $slug .= "-ID$count";
        }

        

        return $slug;
    }
    public function created(Category $category): void
    {   
        $slug = $this->generateUniqueSlug($category->slug);
        $category->slug = $slug;
        $category->save();
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
