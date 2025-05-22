<?php

namespace App\Repositories;

use App\DTO\AuthDTO;
use App\Models\User;
use Illuminate\Support\Str;
use App\Interfaces\Repositories\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface{
  public function store(AuthDTO $data){
 $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
                'verification_token' => Str::random(60),
            ]);
    return $user->refresh();
    }
    public function find($email){
        $user = User::where('email', operator: $email)->first();
        return $user;
    }
     public function deleteToken($user){
     $user->tokens()->delete();
     }
     public function createToken($user){
    $token = $user->createToken('auth_token')->plainTextToken;
    return $token;
     }
    public function refreshToken($user)
    {
    $user->tokens()->delete();
    return $user->createToken('auth_token')->plainTextToken; 
    }





}
