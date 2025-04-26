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

   
}
