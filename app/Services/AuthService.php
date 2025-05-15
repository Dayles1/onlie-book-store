<?php

namespace App\Services;

use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Models\User;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\AuthServiceInterface;

class AuthService extends BaseService  implements  AuthServiceInterface
{
    public function __construct(protected AuthRepositoryInterface $authRepository){}
      public function register(array $data)
        {
            $user=$this->authRepository->store($data);
            $url=request()->getSchemeAndHttpHost();
            SendEmailJob::dispatch($user,$url);
            return $user;
        }
        public function login(array $data)
    {
        $user=$this->authRepository->find($data['email']);
     if (!$user) {
        return ['status'=>'credentials_error'];
    }
    if (!Hash::check($data['password'], $user->password)) {
        return ['status'=>'credentials_error'];
    }
    if (is_null($user->email_verified_at)) {
        return ['status'=>'not_verified'];
    }
    $token=$this->authRepository->createToken($user);
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
