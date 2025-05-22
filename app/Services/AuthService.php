<?php

namespace App\Services;

use App\DTO\AuthDTO;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Repositories\AuthRepositoryInterface;

class AuthService extends BaseService  implements  AuthServiceInterface
{
    public function __construct(protected AuthRepositoryInterface $authRepository){}
      public function register(AuthDTO  $data)
        {
            $user=$this->authRepository->store($data);
            $url=request()->getSchemeAndHttpHost();
            SendEmailJob::dispatch($user,$url);
            return $user;
        }
      public function login(AuthDTO $data)
    {
        $user=$this->authRepository->find($data->email);
     if (!$user) {
        return ['status'=>'credentials_error'];
    }
    if (!Hash::check($data->password, $user->password)) {
        return ['status'=>'credentials_error'];
    }
    if (is_null($user->email_verified_at)) {
        return ['status'=>'not_verified'];
    }
    $token = $this->authRepository->refreshToken($user);

    return [
        'status' => 'success',
        'token' => $token,
        'user' => $user,
    ];}
     public function logout()    
        {
         $user = auth()->user();
        $token=$this->authRepository->deleteToken($user);
        }
    
}
