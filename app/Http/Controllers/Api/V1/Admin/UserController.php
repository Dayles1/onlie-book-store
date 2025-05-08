<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{   
    public function __construct(protected UserServiceInterface $userService)
    {
    }
    public function index()
    {   
        $users = $this->userService->index();
        return $this->responsePagination($users,UserResource::collection($users), __('message.user.show_success'));
    }
    public function store(UserStoreRequest $request)
    {
      $user = $this->userService->store($request);
        return $this->success($user,__('message.user.create_success'),  201);
    }
    public function show($id)
    {
        $user = $this->userService->show($id);        
        return $this->success($user, __('message.user.show_success'));
    }
    public function update(UserUpdateRequest $request, $id)
    {   
        $data=$request->all();
      $user = $this->userService->update($data, $id);
      if($user['status'] == 'admin'){
        return $this->error( __('message.user.status_error'), 403);
    }
        return $this->success($user, __('message.user.update_success'));
    }
    public function destroy($id)
    {
        $user = $this->userService->destroy($id);        
        if($user['status'] == 'admin'){
            return $this->error( __('message.user.status_error'), 403);
        }


        $user->delete();
        return $this->success(null, __('message.user.delete_success'));
    }
   
}
