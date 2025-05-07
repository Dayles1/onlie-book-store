<?php 
namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Interfaces\Services\CategoryServiceInterface;

class CategoryController extends Controller
{
    public function __construct(protected CategoryServiceInterface $categoryService)
    {
    }
   

   

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category([
            'parent_id' => $request->parent_id,
        ]);

        $translations = $this->prepareTranslations($request->translations, ['title']);
        $category->fill($translations)->save();
    
        return $this->success(new CategoryResource($category), __('message.category.create_success'));
    }
    
    
    public function update(CategoryUpdateRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $translations = $this->prepareTranslations($request->translations, ['title']);
        $category->fill($translations);

        $category->updated_at = now();

        $category->save();

        return $this->success(new CategoryResource($category), __('message.category.update_success'));
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }

        $category->delete();
        return $this->success(null, __('message.category.delete_success'));
    }
}
