<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(){
           return Category::paginate(10);
    }
    public function find($find){}
    public function store($request){}
    public function update($request){}
    public function destroy(){}
    
}
