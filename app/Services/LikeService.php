<?php

namespace App\Services;

use App\Models\Like;
use App\Interfaces\Services\LikeServiceInterface;

class LikeService extends BaseService implements LikeServiceInterface
{
    public function index(){
        $likes = Like::with('book')->where('user_id', Auth::id())->paginate(10);
        return $likes;
    }
    public function LikeDislike(){

    }
}
