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
        $categories = Category::paginate(10);
        return $categories;
    }
    public function show($slug)
    {
        $category = Category::with(['children','books'])->where('slug', $slug)->firstOrFail();
    
        return $category;
       
    }
    public function store($data)
    {   
        $category = new Category([
            'parent_id' => $data['parent_id'] ?? null,
        ]);
        

        $translations = $this->prepareTranslations($data['translations'], ['title']);

        $category->fill($translations)->save();
        return $category;
    
    }
    public function update($data, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $translations = $this->prepareTranslations($data['translations'], ['title']);
        $category->fill($translations);

        $category->updated_at = now();

        $category->save();
        return $category;
        
    }
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->delete();
        return ['status'=>'success'];
        
    }

}
