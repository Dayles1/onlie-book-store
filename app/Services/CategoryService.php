<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Interfaces\Services\CategoryServiceInterface;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        $categories = Category::paginate(10);
        return $categories;
    }
    public function show($slug)
    {
        $category = Category::with([
            'books' => function($query) {
                $query->paginate(10); 
            },
            'children'
        ])
        ->where('slug', $slug)
        ->firstOrFail();
        return $category;
    }
    public function search($request)
    {
        
    }
    public function store($data)
    {   
        $category = new Category([
            'parent_id' => $data->parent_id,
        ]);

        $translations = $this->prepareTranslations($data->translations, ['title']);
        $category->fill($translations)->save();
    
    }
    public function update($data, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $translations = $this->prepareTranslations($data->translations, ['title']);
        $category->fill($translations);

        $category->updated_at = now();

        $category->save();
        return $category;
        
    }
    public function destroy($slug)
    {
        
    }

}
