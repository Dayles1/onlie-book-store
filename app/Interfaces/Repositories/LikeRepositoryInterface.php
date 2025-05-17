<?php

namespace App\Interfaces\Repositories;

interface LikeRepositoryInterface
{
    public function index();
    public function LikeDislike($bookId);
}
