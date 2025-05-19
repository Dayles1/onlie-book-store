<?php

namespace App\Interfaces\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function find($find);
    public function store($category, $translations);
    public function update($category);
    public function destroy($category);
    public function show($slug);

}
