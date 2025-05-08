<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($data, $id);
    public function destroy($id);
}
