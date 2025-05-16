<?php
namespace App\Http\Controllers\Api\V1\User;
use App\Models\Book;


use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;    
use App\Interfaces\Services\BookServiceInterface;

class BookController extends Controller
{
    public function __construct(protected BookServiceInterface $bookService)
    {
    }
    public function index()
    {
        $books=$this->bookService->index();
        return $this->responsePagination(
            $books,
            BookResource::collection($books),
            __('message.book.index_success'),
            200
        );
           
    }
    public function show($slug)
    {
        $book = $this->bookService->show($slug);
        return $this->success(
            new BookResource($book),
            __('message.book.show_success'),
            200
        );
    }
    public function search(Request $request)
    {
       $books = $this->bookService->search($request->all());
       
        return $this->responsePagination(
             
            $books,
             BookResource::collection($books),
            __('message.book.index_success'),);
        
    }
}
