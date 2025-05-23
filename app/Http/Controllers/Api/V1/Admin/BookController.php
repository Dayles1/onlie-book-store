<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\DTO\BookDTO;
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
        $dto= BookDTO::fromArray($request->validated());
        $book = $this->bookSercvice->store($dto);
        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.create_success'),
            201
        );
    }
    public function update(BookUpdateRequest $request, $slug)
    {
        $dto= BookDTO::fromArray($request->validated());

        $book = $this->bookSercvice->update($dto , $slug);

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


