<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\Services\AuthServiceInterface;
use App\DTO\AuthDTO;

class AuthController extends Controller
{

    public function __construct(protected AuthServiceInterface $authService)
    {
    }

public function register(RegisterRequest $request)
{
    $dto = AuthDTO::fromArray($request->only(['name', 'email', 'password']));
    $user = $this->authService->register($dto);
    $user->refresh();

    return $this->success(new UserResource($user), __('message.auth.register.success'), 201);
}


    public function login(LoginRequest $request)
    {
        $dto = AuthDTO::fromArray($request->only([ 'email', 'password']));
        $login = $this->authService->login($dto);
    if($login['status'] == 'credentials_error'){
        return $this->error(__('message.auth.login.error'), 401);
    }
    if($login['status'] == 'not_verified'){
        return $this->error(__('message.auth.login.verify'), 401);
    }
    
        return $this->success([
            'user' => new UserResource($login['user']),
            'token' => $login['token'],
        ], __('message.auth.login.success'), 200);
    }
    
    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return $this->error(__('message.auth.verify.error'), 404);
        }

        $user->email_verified_at = now();
        $user->save();

        return $this->success(new UserResource($user), __('message.auth.verify.success'), 200);
    }
    public function logout()
    {
        $this->authService->logout();
        return $this->success(null, __('message.auth.logout'), 200);
    }
}
