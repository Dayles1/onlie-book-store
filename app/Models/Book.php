<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Book extends Model implements TranslatableContract    
{
    use Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $table = 'books';

   



    protected $fillable = [ 'slug',  'author', 'price','original_title'];

    // 

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_books');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
   
}