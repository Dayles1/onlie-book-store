<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function adminRegister(RegisterRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verification_token' => bin2hex(random_bytes(16)),
            'password' => bcrypt($request->password),
            'status' => 'admin',
        ]);
        
        $url=request()->getSchemeAndHttpHost();
        SendEmailJob::dispatch($user,$url);
    
        // Mail::to($user->email)->send(new SendEmailVerification($user,$url));

        return $this->success($user, __('message.auth.register.success'), 201);
    }

    public function login(LoginRequest $request)
    {
        $user=User::where('email', $request->email)->first();
        if($user->email_verified_at==null){
            return $this->error(__('message.auth.login.verify'), 401);
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->error(__('message.auth.login.error'), 401);
        }
        $token = auth()->user()->createToken('auth_token')->plainTextToken;
        $user = auth()->user();
        return $this->success([
            'user' => $user,
            'token' => $token
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

        return $this->success($user, __('message.auth.verify.success'), 200);
    }
    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success(null, __('message.auth.logout'), 200);
    }
}
