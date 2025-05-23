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
    public function store($data, $translations)
    {
        $category = new Category();
        $category->parent_id = $data->parent_id ?? null;
        $category->saveQuietly();
        
        $category->setTranslations($translations);
        sleep(1); 

        $category->touch();
        return $category;
    }
    public function show($slug)
    {
        $category = Category::with(['children', 'books'])->where('slug', $slug)->firstOrFail();
        return $category;

    }
    public function update($category,$translations,$data)
    {
        $category->setTranslations($translations);
        if($data->parent_id !==null){
        $category->parent_id=$data->parent_id;
    }
        $category->touch();
        return $category;

    }
    public function destroy($category)
    {
        $category->delete();

    }

}
