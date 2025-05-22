<?php

namespace App\Interfaces\Repositories;

use App\DTO\AuthDTO;

interface AuthRepositoryInterface
{
    public function find($find);
    public function store(AuthDTO $request);
    public function deleteToken($user);
    public function createToken($user);
    public function refreshToken($user);


}
