<?php

namespace App\DTO;

class CategoryDTO
{
    public array $translations;
    public ?int $parent_id;

    public function __construct(array $translations, ?int $parent_id = null)
    {
        $this->translations = $translations;
        $this->parent_id = $parent_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            translations: $data['translations'] ?? [],
            parent_id: isset($data['parent_id']) ? (int) $data['parent_id'] : null,
        );
    }
}
