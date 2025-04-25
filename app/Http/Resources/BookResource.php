<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ExchangeRate;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $usd = ExchangeRate::where('code', 'USD')->orderByDesc('date')->first()?->rate ?? 1;
        $rub = ExchangeRate::where('code', 'RUB')->orderByDesc('date')->first()?->rate ?? 1;

        return [
            'id' => $this->id,
            'title' => $this->title, 
            'slug' => $this->slug,
            'description' => $this->description,
            'author' => $this->author,
            'price_uzs' => $this->price . ' UZS',
            'price_usd' => round($this->price / $usd, 2) . ' $',
            'price_rub' => round($this->price / $rub, 2) . ' ₽',
            'categories' => $this->whenLoaded('categories', fn () => $this->categories->pluck('title')),
            'images' => $this->whenLoaded('images', fn () => $this->images->pluck('url')),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
