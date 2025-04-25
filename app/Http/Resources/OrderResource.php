<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'book'   => new BookResource($this->whenLoaded('book')),
            'user'   => new UserResource($this->whenLoaded('user')),
            'stock'  => $this->stock,
            'status' => $this->status,
            'address' => $this->address,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
