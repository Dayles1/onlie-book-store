<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Interfaces\Services\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(protected UserRepositoryInterface $userRepository){}

    public function index()
    {
        $users = User::paginate(10);
        return $users;
    }
    public function show($id){
        $user = User::findOrFail($id);
        return $user;
    }
    public function store($request){
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role'=> $request->role,
            'email_verified_at'=> now(),
           ]);
           return $user;
    }   
    public function update($data,$id){
        $user = User::findOrFail($id);
        if($user->role == 'admin'){
            return ['status'=>'admin'];
        }
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        if($user->role == 'admin'){
            return ['status'=>'admin'];
        }
        return $user;
    }
}
