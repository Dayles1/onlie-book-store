<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    
    public function store(BookStoreRequest $request)
    {
        // Шаг 1: создаём книгу без переводов
        $book = new Book([
            'author' => $request->author,
            'price'  => $request->price,
        ]);
    
        // ⚠️ Здесь сохраняем временно переводы для обсервера (не пишутся в БД)
        $book->setRelation('translations_cache', collect($request->translations));
    
        // Сохраняем книгу — теперь сработает observer `created()`
        $book->save();
    
        // Шаг 2: привязываем категории
        $book->categories()->attach($request->categories);
    
        // Шаг 3: сохраняем переводы в отдельную таблицу через fill + save
        $translations = $this->prepareTranslations($request->translations, ['title', 'description']);
        $book->fill($translations);
        $book->save(); // сохранит fillable-переводы (если используется package типа spatie/laravel-translatable)
    
        // Шаг 4: сохраняем изображения
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
    
        // Шаг 5: возвращаем успешный ответ
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
