<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Book extends Model 
{
    use Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $table = 'books';

    protected $fillable = ['slug', 'author', 'price',];

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
    public function getPriceInUsdAttribute()
    {
        $rate = \App\Models\ExchangeRate::where('code', 'USD')->latest()->first()?->rate ?? 1;
        return round($this->price / $rate, 2);
    }

    public function getPriceInRubAttribute()
    {
        $rate = \App\Models\ExchangeRate::where('code', 'RUB')->latest()->first()?->rate ?? 1;
        return round($this->price / $rate, 2);
    }

}