<?php

namespace App\Interfaces\Repositories;

interface BookRepositoryInterface
{
      public function index();
    public function show($slug);
    public function store($request, $book,$images);
    public function update($data, $book, $images);
    public function destroy($slug);
    public function search(array $request);
    public function findBySlug($slug);
}
