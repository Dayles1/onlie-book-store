<?php

namespace App\Services;

use App\Models\Category;
use App\Interfaces\Services\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        $categories = Category::paginate(10);
        return $categories;
    }
    public function show($slug)
    {
        // Logic for fetching a single category by slug
    }
    public function search($request)
    {
        // Logic for searching categories
    }
    public function store($data)
    {
        // Logic for storing a new category
    }
    public function update($data, $slug)
    {
        // Logic for updating a category by slug
    }
    public function destroy($slug)
    {
        // Logic for deleting a category by slug
    }

}
