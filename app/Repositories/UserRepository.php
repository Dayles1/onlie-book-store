<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\DTO\UserDTO;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::paginate(10);
    }

    public function find(int $id)
    {
        return User::findOrFail($id);
    }

    public function store($dto)
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
            'role' => $dto->role,
            'email_verified_at' => now(),
        ]);
    }

    public function update($dto,  $user)
    {

        $user->update([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
            'role' => $dto->role,
        ]);

        return $user;
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return ['status' => 'admin'];
        }

        $user->delete();
        return ['status' => 'success'];
    }
}
