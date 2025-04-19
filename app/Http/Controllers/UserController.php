<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        // Validate the request data
       

       $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'email_verified_at'=> now(),
       ]);

        return response()->json(['message' => __('message.user.create_success'), 'user' => $user], 201);
    }
}
