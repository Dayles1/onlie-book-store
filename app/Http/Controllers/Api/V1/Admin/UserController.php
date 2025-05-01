<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{   
    public function index()
    {
        $users = User::paginate(10);
        return $this->responsePagination($users,UserResource::collection($users), __('message.user.show_success'));
    }
    public function store(UserStoreRequest $request)
    {

       $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'role'=> $request->role,
        'email_verified_at'=> now(),
       ]);


        return $this->success($user,__('message.user.create_success'),  201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return $this->success($user, __('message.user.show_success'));
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($user->role == 'admin'){
            return $this->error(__('message.user.status_error'), 403);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return $this->success($user, __('message.user.update_success'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if($user->role == 'admin'){
            return $this->error(__('message.user.status_error'), 403);
        }

        $user->delete();
        return $this->success(null, __('message.user.delete_success'));
    }
   
}
