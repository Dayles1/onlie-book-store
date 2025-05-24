<?php

namespace App\DTO;

class UserDTO
{
     public string $name;
    public string $email;
    public string $password;
    public string $role;
    public function __construct($name, $email, $password, $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
     
    

    }
    public static function fromRequest(array $data): self
{
    return new self(
        name: $data['name'],
        email: $data['email'],
        password: $data['password'],
        role: $data['role'],
    );
}

}
