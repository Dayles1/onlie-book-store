<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
  public function index(){}
    public function show($slug){}
    public function store($data){}
    public function update($data, $slug){}
    public function destroy(){}
   
}
