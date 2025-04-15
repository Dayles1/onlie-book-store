<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verification_token' => bin2hex(random_bytes(16)),
            'password' => bcrypt($request->password),
        ]);
        $url=request()->getSchemeAndHttpHost();
        SendEmailJob::dispatch($user,$url);

        return $this->success($user, __('message.auth.register.success'), 201);
    }

    public function login(LoginRequest $request)
    {
        

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->error(__('message.auth.login.error'), 401);
        }

        $user = auth()->user();
        return $this->success($user, __('message.auth.login.success'), 200);
    }
}
