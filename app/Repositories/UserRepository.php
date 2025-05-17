<?php
namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;

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

    public function store($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);
    }

    public function update($data, int $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return ['status' => 'admin'];
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
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
