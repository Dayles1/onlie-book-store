<?php

namespace App\Repositories;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Repositories\LikeRepositoryInterface;

class LikeRepository implements LikeRepositoryInterface
{
    public function index()
    {
        $likes = Like::with('book')->where('user_id', Auth::id())->paginate(10);
        return $likes;
    }
    public function LikeDislike($bookId)
    {

    }
}
