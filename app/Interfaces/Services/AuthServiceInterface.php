<?php

namespace App\Interfaces\Services;

use App\DTO\AuthDTO;

interface AuthServiceInterface
{
    public function login(array $data);
    public function register(array $data);
    public function logout();
}
