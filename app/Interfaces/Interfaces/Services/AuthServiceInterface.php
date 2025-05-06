<?php

namespace App\Interfaces\Interfaces\Services;

interface AuthServiceInterface
{
    public function login(array $data);
    public function register(array $data);
    public function logout();
}
