<?php

namespace App\DTO;

class AuthDTO
{
    protected string $name;
    protected string $email;
    protected string $password;
    public function __construct(string $name, string $email, string $password)
    {
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password']
        );
    }
}
