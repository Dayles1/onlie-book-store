<?php

namespace App\Interfaces\Services;

interface NotificationServiceInterface
{
    public function index();
    public function show($id);
    public function readed();
    public function unread();
}
