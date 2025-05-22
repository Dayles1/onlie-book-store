<?php

namespace App\DTO;

class BookDTO
{
    public array $translations;
    public string $author;
    public float|int $price;
    public string $originalTitle;
    public array $categories;

    public function __construct(
        array $translations,
        string $author,
        float|int $price,
        string $originalTitle,
        array $categories
    ) {
        $this->translations = $translations;
        $this->author = $author;
        $this->price = $price;
        $this->originalTitle = $originalTitle;
        $this->categories = $categories;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            translations: $data['translations'] ?? [],
            author: $data['author'],
            price: $data['price'],
            originalTitle: $data['original_title'],
            categories: $data['categories'] ?? [],
        );
    }
}
