<?php 
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
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
        $data = $request->all();
        $category = $this->categoryService->store($data);
        return $this->success(new CategoryResource($category), __('message.category.create_success'));
    }
    public function update(CategoryUpdateRequest $request, $slug)
    {
       $data= $request->all();
       $category = $this->categoryService->update($data, $slug);
        return $this->success(new CategoryResource($category), __('message.category.update_success'));
    }

    public function destroy($slug)
    {
       $category = $this->categoryService->destroy($slug);
    //    if($category['status'] == 'success'){
            return $this->success(null, __('message.category.delete_success'));
        // }

    }
}
