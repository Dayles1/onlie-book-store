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
    public function likeDislike($bookId)
    {
            $userId = Auth::id();
        $like = Like::where('user_id', $userId)->where('book_id', $bookId)->first();
        if ($like) {
            $like->delete();
            return ['status'=>'delete'];
        }
        
        else {
            Like::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);
            return ['status'=>'create'];
        }

    }
}
