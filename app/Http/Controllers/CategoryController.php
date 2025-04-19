<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {   
        $category =Category::create([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
        ]);
        
       

    }
}
