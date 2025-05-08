<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\Services\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
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

    public function update($request,$id){

    }
    public function destroy($id){

    }
}
