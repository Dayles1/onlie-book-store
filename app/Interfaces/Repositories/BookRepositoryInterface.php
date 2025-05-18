<?php

namespace App\Interfaces\Repositories;

interface BookRepositoryInterface
{
      public function index();
    public function show($slug);
    public function store($request, $book);
    public function update($data, $book);
    public function destroy($book);
    public function updatePhoto( $image);
    public function destroyPhoto( $image);
    public function search(array $request);
    public function findBySlug($slug);
}
