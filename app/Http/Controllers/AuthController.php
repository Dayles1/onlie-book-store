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
    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success'=>false,
                'message'=>'Token not found'
            ]);
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json([
            'success'=>true,
            'message'=>'Email verified'
        ]);}
    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success(null, __('message.auth.logout'), 200);
    }
}

