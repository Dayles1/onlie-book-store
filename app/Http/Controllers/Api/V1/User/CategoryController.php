<?php 
namespace App\Http\Controllers\Api\V1\User;

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
    public function index(Request $request)
    {
        $categories = Category::paginate(10);

        return $this->responsePagination(
            $categories,
            CategoryResource::collection($categories),
            __('message.category.index_success')
        );
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
    
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
    
        return $this->success(
            new CategoryResource($category),
            __('message.category.show_success')
        );
    }

   
    public function search(Request $request)
    {
        $query = \App\Models\Book::query();
    
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('author', 'like', "%{$search}%")
                  ->orWhere('title->uz', 'like', "%{$search}%")  // Uzbek title
                  ->orWhere('title->ru', 'like', "%{$search}%")  // Russian title
                  ->orWhere('description->uz', 'like', "%{$search}%")
                  ->orWhere('description->ru', 'like', "%{$search}%");
            });
        }
    
        if ($category = $request->input('category')) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category)
                  ->orWhere('title->uz', 'like', "%{$category}%")
                  ->orWhere('title->ru', 'like', "%{$category}%");
            });
        }
    
        $books = $query->paginate(10);
    
        return $this->responsePagination(
            $books,
        BookResource::collection($books),
          __('message.book.search_success'));
        
    }
    
}
