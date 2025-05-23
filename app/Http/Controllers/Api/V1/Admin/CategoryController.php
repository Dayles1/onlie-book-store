<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\DTO\CategoryDTO;
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
       $dto=new CategoryDTO(
            translations: $request->translations,
            parent_id: $request->parent_id
        );
        $category = $this->categoryService->store($dto);
        return $this->success(new CategoryResource($category->load('translations')), __('message.category.create_success'));
    }
    public function update(CategoryUpdateRequest $request, $slug)
    {
        $dto=new CategoryDTO(
            translations: $request->translations,
            parent_id: $request->parent_id
        );
        $category = $this->categoryService->update( $dto,$slug);
        return $this->success(new CategoryResource($category), __('message.category.update_success'));
    }

    public function destroy($slug)
    {
        $category = $this->categoryService->destroy($slug);
        return $this->success(null, __('message.category.delete_success'));

    }
}
