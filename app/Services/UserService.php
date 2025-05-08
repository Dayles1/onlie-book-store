<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\Services\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    public function index()
    {
        $users = User::paginate(10);
        return $users;
    }
    public function show($id){

    }
    public function store($request){

    }   

    public function update($request,$id){

    }
    public function destroy($id){

    }
}
