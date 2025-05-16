<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getAll(){
           return Category::paginate(10);
    }
    public function find($find){}
    public function store($data){
        $category = new Category([
            'parent_id' => $data['parent_id'] ?? null,
        ]);
        

        $translations = $this->prepareTranslations($data['translations'], ['title']);

        $category->fill($translations)->save();
        return $category;
    }
    public function update($request){}
    public function destroy(){}
    
}
