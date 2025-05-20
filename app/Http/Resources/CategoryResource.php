<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at'=> $this->updated_at->toDateTimeString(),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'books' => BookResource::collection($this->whenLoaded('books')),
            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'translations' => CategoryTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
