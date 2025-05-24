<?php

namespace App\Interfaces\Repositories;

interface UserRepositoryInterface
{
    public function getAll();
    public function find(int $id);
    public function store($request);
    public function update($data,  $user);
    public function destroy(int $id);
}
