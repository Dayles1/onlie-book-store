<?php

namespace App\Interfaces\Repositories;

interface NotificationRepositoryInterface
{
    public function index();
    public function show($id);
    public function unread();
    public function readed();
}
