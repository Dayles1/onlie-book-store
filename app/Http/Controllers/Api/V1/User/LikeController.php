<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LikeResource;
class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::with('book')->where('user_id', Auth::id())->paginate(10);
        return $this->responsePagination($likes, LikeResource::collection($likes), __('message.like.show_success'));
    }

    public function LikeDislike($bookId)
    {
        $userId = Auth::id();
        $like = Like::where('user_id', $userId)->where('book_id', $bookId)->first();

        if ($like) {
            $like->delete();
            return $this->success([], __('message.like.delete_success'));
        } else {
            Like::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);
            return $this->success([], __('message.like.create_success'));
        }
    }
}
