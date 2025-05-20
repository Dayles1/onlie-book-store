<?php
namespace App\Http\Controllers\Api\V1\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;

use App\Http\Requests\BookUpdateRequest;
use App\Interfaces\Services\BookServiceInterface;

class BookController extends Controller
{
    public function __construct(protected BookServiceInterface $bookSercvice)
    {
    }
    public function store(BookStoreRequest $request)
    {
        $book = $this->bookSercvice->store($request->validated());
        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.create_success'),
            201
        );
    }
    public function update(BookUpdateRequest $request, $slug)
    {
        $book = $this->bookSercvice->update($request->validated() , $slug);

        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.update_success'),
            200
        );
    }
    public function destroy($slug)
    {
        $book=$this->bookSercvice->destroy($slug);
            return $this->success(null, __('message.book.delete_success'), 200);
    }
}


