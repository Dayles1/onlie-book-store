<?php

namespace App\Services;

use App\Interfaces\Repositories\LikeRepositoryInterface;
use App\Models\Book;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\LikeServiceInterface;

class LikeService extends BaseService implements LikeServiceInterface
{
    public function __construct(protected LikeRepositoryInterface $likeRepository){}

    public function index(){
        $likes =$this->likeRepository->index();
        return $likes;
    }
    public function likeDislike($bookId){
        $like = $this->likeRepository->LikeDislike($bookId);
    return $like;
    
}
}