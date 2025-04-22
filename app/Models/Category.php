<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Category extends Model implements TranslatableContract    
{
    use Translatable;

    public $translatedAttributes = ['title'];

    protected $fillable = ['slug',  'parent_id'];

    // protected $casts = [
    //     'title' => 'array',
    // ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'category_books');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}