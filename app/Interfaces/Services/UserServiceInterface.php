<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function index($id);
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
}
