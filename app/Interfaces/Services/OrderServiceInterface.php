<?php

namespace App\Interfaces\Services;

interface OrderServiceInterface
{
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($id);

}
