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

        return $this->success($user,__('message.user.create_success'),  201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error(__('message.user.not_found'), 404);
        }
        return $this->success($user, __('message.user.show_success'));
    }
}
