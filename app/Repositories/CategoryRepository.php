<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::paginate(10);
    }
    public function find($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return $category;

    }
    public function store($category, $translations)
    {
        $category = Category::create([
            'parent_id' => $category['parent_id'] ?? null
        ]);
        info('translations', [
            'translations' => $translations
        ]);
        $category->setTranslations($translations);
        $category->save();
        // info('category', [
        //     'category' => $category
        // ]);
        return $category;
    }
    public function show($slug)
    {
        $category = Category::with(['children', 'books'])->where('slug', $slug)->firstOrFail();
        return $category;

    }
    public function update($category)
    {
        $category->save();
        return $category;

    }
    public function destroy($category)
    {
        $category->delete();

    }

}
