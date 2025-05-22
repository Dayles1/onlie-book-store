<?php

namespace App\DTO;

class BookDTO
{
    public array $translations;
    public string $author;
    public float|int $price;
    public array $categories;

    public function __construct(
        array $translations,
        string $author,
        float|int $price,
        array $categories
    ) {
        $this->translations = $translations;
        $this->author = $author;
        $this->price = $price;
        $this->categories = $categories;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            translations: $data['translations'] ?? [],
            author: $data['author'] ?? '',
            price: $data['price'] ?? '',
            categories: $data['categories'] ?? [],
        );
    }
}
