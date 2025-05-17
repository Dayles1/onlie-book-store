<?php

namespace App\Interfaces\Repositories;

interface OrderRepositoryInterface
{
    public function store($request);
    public function index();
    public function destroy($id);
    public function update($request, $id);
}
