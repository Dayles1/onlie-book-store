<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'author' => $this->author,
            'price' => $this->price,
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            // 'orders' => OrderResource::collection($this->whenLoaded('orders')),
            // 'likes' => LikeResource::collection($this->whenLoaded('likes')),
        ];
    }
}
