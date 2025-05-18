<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepository  implements CategoryRepositoryInterface
{
    public function getAll(){
           return Category::paginate(10);
    }
    public function find($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        return $category;   

    }
    public function store($category){
        $category->save();
        return $category;
    }
    public function show($slug){
        $category = Category::with(['children','books'])->where('slug', $slug)->firstOrFail();
        return $category;
        
    }
    public function update($data,$category){

        $translations = $this->prepareTranslations($data['translations'], ['title']);
        $category->fill($translations);

        $category->updated_at = now();
        $category->save();
        return $category;

    }
    public function destroy($category){
        $category->delete();

    }
    
}
