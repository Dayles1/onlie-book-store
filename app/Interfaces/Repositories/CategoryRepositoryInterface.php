<?php

namespace App\Interfaces\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function find($find);
    public function store($request);
    public function update($request);
    public function destroy();
    public function show($slug);

}
