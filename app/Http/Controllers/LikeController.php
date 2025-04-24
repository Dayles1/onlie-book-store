<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::with('book')->where('user_id', Auth::id())->paginate(10);
        return response()->json($likes);
    }

    public function LikeDeathlike($bookId)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('book_id', $bookId)
                    ->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Removed from wishlist']);
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
            ]);
            return response()->json(['message' => 'Added to wishlist']);
        }
    }
}
