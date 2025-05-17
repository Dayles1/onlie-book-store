<?php

namespace App\Interfaces\Repositories;

interface OrderRepositoryInterface
{
    public function store($request);
    public function sendNotify($order);
    public function index($user);
    public function indexAdmin();
    public function find($id);
    public function destroy($order);
    public function update($request, $order);
}
