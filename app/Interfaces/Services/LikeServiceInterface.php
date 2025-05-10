<?php

namespace App\Interfaces\Services;

interface LikeServiceInterface
{
    public function index();
    public function LikeDislike($bookId);
}
