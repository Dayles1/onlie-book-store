<?php

namespace App\Services;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository){}

   
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }
    public function show($slug)
    {
        $category = $this->categoryRepository->show($slug);
        return $category;
       
    }
    public function store($data)
    {   
        $category=$this->categoryRepository->store($data);
        return $category;
    
    }
    public function update($data, $slug)
    {
        $category = $this->categoryRepository->find($slug);
        $category=$this->categoryRepository->update($data, $category);
        return $category;
        
    }
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->delete();
        return ['status'=>'success'];
        
    }

}
