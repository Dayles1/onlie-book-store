<?php

namespace App\Services;

use App\Models\User;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\AuthServiceInterface;

class AuthService extends BaseService  implements  AuthServiceInterface
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
        
            return $user;
        }
        public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

     if (!$user) {
        return response()->json([
            'message' => __('message.auth.login.error'),
        ], 404);
    }

    if (is_null($user->email_verified_at)) {
        return response()->json([
            'message' => __('message.auth.login.verify'),
        ], 401);
    }

    if (!Hash::check($data['password'], $user->password)) {
        return response()->json([
            'message' => __('message.auth.login.error'),
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return [
        'user' => $user,
        'token' => $token
    ];
}
      
        public function logout()    
        {
         $user = auth()->user();
         $user->tokens()->delete();
        }
    
}
