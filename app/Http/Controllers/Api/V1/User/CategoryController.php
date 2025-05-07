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
        $categories = $this->categoryService->index();
        return $this->responsePagination(  $categories,  CategoryResource::collection($categories),  __('message.category.index_success')
        );
    }

    public function show($slug)
    {
      $category = $this->categoryService->show($slug);
        return $this->success( new CategoryResource($category), __('message.category.show_success'));
    }

   
    // public function search(Request $request)
    // {
    //     $books= $this
       
    
    //     return $this->responsePagination(
    //         $books,
    //     BookResource::collection($books),
    //       __('message.book.index_success'));
        
    // }
    
}
