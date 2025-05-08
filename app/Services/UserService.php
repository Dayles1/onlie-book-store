<?php

namespace App\Services;

use App\Interfaces\Services\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    public function index($request){}
    public function show($id){}
    public function store($request){}   

    public function update($request,$id){}
    public function destroy($id){}
}
