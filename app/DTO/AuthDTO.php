<?php

namespace App\DTO;

class AuthDTO
{
    public string $name;
    public string $email;
    public string $password;
    public function __construct(string $name, string $email, string $password)
    {
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['email'],
            $data['password']
        );
    }
    
}

