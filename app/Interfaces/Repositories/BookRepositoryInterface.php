<?php

namespace App\Interfaces\Repositories;

interface BookRepositoryInterface
{
      public function index();
    public function show($slug);
    public function store($data);
    public function update($data, $slug);
    public function destroy();
}
