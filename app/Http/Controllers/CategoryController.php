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
}
