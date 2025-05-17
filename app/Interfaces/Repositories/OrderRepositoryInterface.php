<?php

namespace App\Interfaces\Repositories;

interface OrderRepositoryInterface
{
    public function store($request);
    public function sendNotify($order);
    public function index();
    public function indexAdmin();

    public function destroy($id);
    public function update($request, $id);
}
