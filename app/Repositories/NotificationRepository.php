<?php

namespace App\Repositories;

use App\Interfaces\Repositories\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function index(){
         $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);
        return $notifications;
    }
    public function show($id){}
    public function unread(){}
    public function readed(){}
}
