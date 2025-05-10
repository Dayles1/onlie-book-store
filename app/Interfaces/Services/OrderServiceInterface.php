<?php

namespace App\Interfaces\Services;

interface OrderServiceInterface
{
    public function index();
    public function store($request);
    public function edit($request, $id);
    public function destroy($id);

    public function adminEdit($request, $id);
}
