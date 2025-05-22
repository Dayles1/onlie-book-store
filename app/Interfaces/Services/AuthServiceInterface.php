<?php

namespace App\Interfaces\Services;

use App\DTO\AuthDTO;

interface AuthServiceInterface
{
    public function login(AuthDTO $data);
    public function register(AuthDTO $data);
    public function logout();
}
