<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Interfaces\Repositories\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface{
  public function store($data){
 $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'verification_token' => Str::random(60),
            ]);
    return $user->refresh();
    }
    public function find($find){
        
    }
     public function logout(){}


}
