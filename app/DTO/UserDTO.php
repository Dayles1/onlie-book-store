<?php

namespace App\DTO;

class UserDTO
{
    public ?string $name;
    public ?string $email;
    public ?string $password;
    public ?string $role;

    public function __construct(?string $name, ?string $email, ?string $password, ?string $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null,
            $data['role'] ?? null
        );
    }
}
