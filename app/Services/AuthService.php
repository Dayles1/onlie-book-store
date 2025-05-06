<?php

namespace App\Services;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use App\Interfaces\Interfaces\Services\AuthServiceInterface;

class AuthService   implements AuthServiceInterface
{
      public function register(array $data)
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'verification_token' => Str::random(60),
            ]);

            $url=request()->getSchemeAndHttpHost();
            SendEmailJob::dispatch($user,$url);
        
            
        }
        public function login(array $data)
        {
            
        }
      
        public function logout()    
        {
            
        }
    
}
