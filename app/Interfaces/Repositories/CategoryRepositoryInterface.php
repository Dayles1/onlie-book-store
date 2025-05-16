<?php

namespace App\Interfaces\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function find($find);
    public function store($request);
    public function update($request,$category);
    public function destroy($category);
    public function show($slug);

}
