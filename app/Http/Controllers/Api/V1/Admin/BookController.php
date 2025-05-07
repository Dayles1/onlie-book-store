<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\Models\Book;
// public function store(BookStoreRequest $request)
//     {
//         $book = new Book([
//             'author' => $request->author,
//             'price'  => $request->price,
//         ]);
    
//         $book->setRelation('translations', collect($request->translations));
//         $book->save();
    
//         $book->categories()->attach($request->categories);
        
//         $translations = $this->prepareTranslations($request->translations, ['title', 'description']);
//         $book->fill($translations);
//         $book->save();
    
//         $images = [];
//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 $images[] = [
//                     'path'            => $this->uploadPhoto($image, 'products'),
//                     'imageable_id'    => $book->id,
//                     'imageable_type'  => Book::class,
//                 ];
//             }
//             Image::insert($images);
//         }
    
//         return $this->success(
//             new BookResource($book->load(['images', 'categories'])),
//             __('message.book.create_success'),
//             201
//         );
//     }
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;
use App\Interfaces\Services\BookServiceIntarface;

class BookController extends Controller
{
    public function __construct(protected BookServiceIntarface $bookSercvice)
    {
    }
    public function store(BookStoreRequest $request)
    {
        $data= $request->all();
        $book = $this->bookSercvice->store($data);
        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.create_success'),
            201
        );
    }


    public function update(Request $request, $slug)
    {
        $data=$request->all();
        $book = $this->bookSercvice->update($data , $slug);

        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.update_success'),
            200
        );
    }

    public function destroy($slug)
    {
        $book   = Book::where('slug', $slug)->firstOrFail();
        if (!$book) {
            return $this->error(__('message.book.not_found'), 404);
        }

        foreach ($book->images as $image) {
            $this->deletePhoto($image->path);
        }

        $book->delete();

        return $this->success(null, __('message.book.delete_success'), 200);
    }
    
}
