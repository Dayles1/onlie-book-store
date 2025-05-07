<?php
namespace App\Http\Controllers\Api\V1\User;
use App\Models\Book;


use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;
use App\Http\Controllers\Controller;    
use App\Interfaces\Services\BookServiceIntarface;

class BookController extends Controller
{
    public function __construct(protected BookServiceIntarface $bookService)
    {
    }
    public function index()
    {
        $books=$this->bookService->index();
        return $this->responsePagination(
            BookResource::collection($books),
            $books->items(),
            __('message.book.index_success'),
            200
        );
           
    }
   

    public function show($slug)
    {
        $book = Book::with([
            'categories',
            'images',
            
        ])->where('slug', $slug)->firstOrFail();
    
        return $this->success(
            new BookResource($book),
            __('message.book.show_success'),
            200
        );
    }
    public function search(Request $request)
    {
        $query = Book::query();
    
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('author', 'like', "%{$search}%")
                  ->orWhere('title->uz', 'like', "%{$search}%")  // Uzbek title
                  ->orWhere('title->ru', 'like', "%{$search}%")  // Russian title
                  ->orWhere('description->uz', 'like', "%{$search}%")
                  ->orWhere('description->ru', 'like', "%{$search}%");
            });
        }
    
        if ($category = $request->input('category')) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category)
                  ->orWhere('title->uz', 'like', "%{$category}%")
                  ->orWhere('title->ru', 'like', "%{$category}%");
            });
        }
    
        $books = $query->paginate(10);
    
        return $this->responsePagination(
             
            $books,
             BookResource::collection($books),
            __('message.book.index_success'),);
        
    }

   

    
    
}
