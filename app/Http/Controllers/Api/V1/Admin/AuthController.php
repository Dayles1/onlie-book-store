<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
            public function admin()
            {

            
                $adminExists = User::where('role', 'admin')->exists();
            
                if ($adminExists) {
                    return $this->success(
                        null,
                        __('message.admin.already_exists'),
                    );
                }
                $user = Auth::user();

            
                $user->role = 'admin';
                $user->save();
            
                return $this->success(
                    new UserResource($user),
                    __('message.admin.created'),
                );
            }
            
//  App\Http\Controllers\Api\V1\Admin/AuthController; -> login,logout,verifyEmail



}
