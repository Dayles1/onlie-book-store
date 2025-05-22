<?php

namespace App\DTO;

class BookDTO
{
    public array $translations;
    public string $author;
    public ?float $price;  
    public array $categories;
    public array $images;  

    public function __construct(
        array $translations,
        string $author,
        ?float $price,
        array $categories,
        array $images = []
    ) {
        $this->translations = $translations;
        $this->author = $author;
        $this->price = $price;
        $this->categories = $categories;
        $this->images = $images;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            translations: $data['translations'] ?? [],
            author: $data['author'] ?? '',
            price: isset($data['price']) ? (float)$data['price'] : null,
            categories: $data['categories'] ?? [],
            images: $data['images'] ?? [], 
        );
    }
}
