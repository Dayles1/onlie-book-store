<?php

namespace App\Services;

use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Models\User;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\AuthServiceInterface;

class AuthService extends BaseService  implements  AuthServiceInterface
{
    public function __construct(protected AuthRepositoryInterface $authRepository){}
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
        return ['status'=>'credentials_error'];
    }
    if (!Hash::check($data['password'], $user->password)) {
        return ['status'=>'credentials_error'];
    }

    if (is_null($user->email_verified_at)) {
        return ['status'=>'not_verified'];

    }
    $token = $user->createToken('auth_token')->plainTextToken;

    return [
        'status' => 'success',
        'token' => $token,
        'user' => $user,
    ];
}
      
        public function logout()    
        {
         $user = auth()->user();
         $user->tokens()->delete();
        }
    
}
