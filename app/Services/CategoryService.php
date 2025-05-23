<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }


    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }
    public function show($slug)
    {
        $category = $this->categoryRepository->show($slug);
        return $category;

    }
    public function store(CategoryDTO $data)
{   
    $translations = $this->prepareTranslations($data->translations, ['title']);
    $category = $this->categoryRepository->store($data, $translations);

    return $category;
}

    public function update(CategoryDTO $data, $slug)
{
    $category = $this->categoryRepository->find($slug);

    $translations = $this->prepareTranslations($data->translations, ['title']);

    $category = $this->categoryRepository->update($category, $translations, $data);

    return $category;
}

    public function destroy($slug)
    {
        $category = $this->categoryRepository->find($slug);
        $category = $this->categoryRepository->destroy($category);

    }

}
