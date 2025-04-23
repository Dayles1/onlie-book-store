<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResorce;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function store(CategoryStoreRequest $request)
    {
        // Подготовим переводы заранее
        $translations = $this->prepareTranslations($request->translations, ['title']);
    
        // Получим английский заголовок
        $englishTitle = $translations['en']['title'] ?? 'category';
    
        // Создадим категорию с заранее сгенерированным slug
        $category = Category::create([
            'parent_id' => $request->input('parent_id'),
            'slug' => Str::slug($englishTitle),
        ]);
    
        // Применим переводы
        $category->fill($translations)->save();
    
        return $this->success(new CategoryResource($category), __('message.category.create_success'));
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
        return $this->success(new CategoryResource($category), __('message.category.show_success'));
    }
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
        $translations = $this->prepareTranslations($request->translations, ['title']);
        $category->fill($translations)->save();
        return $this->success(new CategoryResource($category), __('message.category.update_success'));
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
        $category->delete();
        return $this->success(null, __('message.category.delete_success'));
    }
}
