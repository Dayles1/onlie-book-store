<?php

namespace App\Interfaces\Repositories;

interface BookRepositoryInterface
{
      public function index();
    public function show($slug);
    public function store($request);
    public function update($data, $slug);
    public function destroy($slug);
    public function search($request);
}
