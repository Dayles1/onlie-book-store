<?php

namespace App\Interfaces\Services;

use App\DTO\CategoryDTO;

interface CategoryServiceInterface
{
 
    public function index();
    public function show($slug);
    public function store(CategoryDTO $data);
    public function update(CategoryDTO $data, $slug);
    public function destroy($slug);
}
