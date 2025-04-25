<?php 
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BookResource;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::paginate(10);

        return $this->success(
            CategoryResource::collection($categories),
            __('message.category.index_success')
        );
    }

    public function show($slug)
    {
        $category = Category::with(['books' => function($query) {
            $query->paginate(10); 
        }, 'children'])
        ->where('slug', $slug)
        ->first();
    
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
    
        return $this->success(
            new CategoryResource($category),
            __('message.category.show_success')
        );
    }
    

    public function store(CategoryStoreRequest $request)
    {
        $translations = $this->prepareTranslations($request->translations, ['title']);
    
        $englishTitle = $translations['en']['title'];
    
        $category = Category::create([
            'parent_id' => $request->input('parent_id'),
            'slug' => Str::slug($englishTitle),
        ]);
    
        $category->fill($translations)->save();
    
        return $this->success(new CategoryResource($category), __('message.category.create_success'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }

        $translations = $this->prepareTranslations($request->translations, ['title']);
        $englishTitle = $translations['en']['title'] ?? $category->slug;
        $category->slug = Str::slug($englishTitle);

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
