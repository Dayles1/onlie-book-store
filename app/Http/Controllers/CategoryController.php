<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResorce;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function create(Request $request)
    {   
        $category =Category::create([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
        ]);
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
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error(__('message.category.not_found'), 404);
        }
        $category->update([
            'title' => $request->input('title'),
        ]);
        return $this->success(new CategoryResource($category), __('message.category.update_success'));
    }
}
