<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\LikeServiceInterface;

class LikeService extends BaseService implements LikeServiceInterface
{
    public function index(){
        $likes = Like::with('book')->where('user_id', Auth::id())->paginate(10);
        return $likes;
    }
    public function LikeDislike($bookId){
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
        }
}
}