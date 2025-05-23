<?php

namespace App\Interfaces\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function find($find);
    public function store( $data, $translations);
    public function update($category,$translations, $data);
    public function destroy($category);
    public function show($slug);

}
