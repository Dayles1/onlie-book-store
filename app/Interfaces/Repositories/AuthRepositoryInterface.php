<?php

namespace App\Interfaces\Repositories;

interface AuthRepositoryInterface
{
    public function find($find);
    public function store($request);
    public function deleteToken();
     public function createToken($user);


}
