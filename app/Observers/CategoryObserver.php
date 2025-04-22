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

        if (Category::where('slug', $slug)->exists()) {
            return $this->generateUniqueSlug($title, $count + 1);
        }

        return $slug;
    }
    public function created(Category $category): void
    {
        // $slug = $this->generateUniqueSlug($title);
        // $category->slug = $slug;
        // $category->saveQuietly();
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        if ($category->isDirty('title')) {
            $slug = $this->generateUniqueSlug($category->title);
            $category->slug = $slug;
            $category->save();
        }
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
