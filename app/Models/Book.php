<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'author', 'price'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

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

    // public function images()
    // {
    //     return $this->morphMany(Image::class, 'imageable');
    // }
}