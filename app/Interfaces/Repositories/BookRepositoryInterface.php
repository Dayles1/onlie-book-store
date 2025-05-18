<?php

namespace App\Interfaces\Repositories;

interface BookRepositoryInterface
{
      public function index();
    public function show($slug);
    public function store($request, $book);
    public function update($data, $book);
    public function destroy($book);
    public function insertImage( $image);
    public function destroyImage( $book);
    public function search(array $request);
    public function findBySlug($slug);
}
