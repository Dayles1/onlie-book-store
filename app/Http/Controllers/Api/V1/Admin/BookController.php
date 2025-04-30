<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller;
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
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    public function store(BookStoreRequest $request)
    {
        $book = new Book([
            'author' => $request->author,
            'price'  => $request->price,
        ]);
    
    
        
        $translations = $this->prepareTranslations($request->translations, ['title', 'description']);
        $book->fill($translations);
        $book->save();
        $book->categories()->attach($request->categories);
    
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = [
                    'path'            => $this->uploadPhoto($image, 'products'),
                    'imageable_id'    => $book->id,
                    'imageable_type'  => Book::class,
                ];
            }
            Image::insert($images);
        }
    
        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.create_success'),
            201
        );
    }

    
    
    

    
    

    public function update(Request $request, $slug)
    {
        $book   = Book::where('slug', $slug)->firstOrFsil();
        if (!$book) {
            return $this->error(__('message.book.not_found'), 404);
        }

        $book->update([
            'author' => $request->author,
            'price' => $request->price,
            'original_title' => $request->original_title,
        ]);

        $book->categories()->sync($request->categories);

        $translations = $this->prepareTranslations($request->translations, ['title', 'description']);
        $book->fill($translations)->save();

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = [
                    'path' => $this->uploadPhoto($image, "products"),
                    'imageable_id' => $book->id,
                    'imageable_type' => Book::class,
                ];
            }
            Image::insert($images);
        }

        return $this->success(
            new BookResource($book->load(['images', 'categories'])),
            __('message.book.update_success'),
            200
        );
    }

    public function destroy($slug)
    {
        $book   = Book::where('slug', $slug)->firstOrFsil();
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
