<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\LikeServiceInterface;

use App\Http\Resources\LikeResource;
class LikeController extends Controller
{
    public function __construct(protected LikeServiceInterface $likeService){}
    public function index()
    {   
        $likes=$this->likeService->index();
        return $this->responsePagination($likes, LikeResource::collection($likes), __('message.like.show_success'));
    }

    public function LikeDislike($bookId)
    {
        $like=$this->likeService->LikeDislike($bookId);
       
       if($like['status']=='delete'){
            return $this->success([], __('message.like.delete_success'));
       }
       if($like['status']=='create'){
            return $this->success([], __('message.like.create_success'));
       }
    }
}

