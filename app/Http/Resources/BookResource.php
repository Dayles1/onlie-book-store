<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $currencyRates = Cache::remember('currency_rates', 60, function () {
            $rates = ExchangeRate::all()->keyBy('code')->pluck('rate', 'code');
            return $rates;
        });

        $priceInUzs = $this->price; 

        $pricesInOtherCurrencies = [];
        foreach ($currencyRates as $code => $rate) {
            $pricesInOtherCurrencies[$code] = round($priceInUzs / $rate, 2);
        }

        return [
            'id' => $this->id,
            'title' => $this->title, 
            'description' => $this->description,
            'slug' => $this->slug,

            'author' => $this->author,
            'likes' => $this->likes->count(),
            'price_uzs' => $priceInUzs . ' UZS',
            'prices' => $pricesInOtherCurrencies, 
            'translations' => $this->whenLoaded('translations', fn () => $this->translations->pluck('title', 'locale')),
            'categories' => $this->whenLoaded('categories', fn () => $this->categories->pluck('title')),
            'images' => $this->whenLoaded('images', fn () => $this->images->pluck('url')),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
