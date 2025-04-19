<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        // Validate the request data
       

       $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'status'=> 'created',
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
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error(__('message.user.not_found'), 404);
        }
        if($user->status !== 'created'){
            return $this->error(__('message.user.status_error'), 403);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $this->success($user, __('message.user.update_success'));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error(__('message.user.not_found'), 404);
        }
        if($user->status !== 'created'){
            return $this->error(__('message.user.status_error'), 403);
        }

        $user->delete();
        return $this->success(null, __('message.user.delete_success'));
    }
}
