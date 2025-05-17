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
    public function show($id){
          $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }
        return $notification;
    }
    public function unread(){
          $notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->paginate(10);
        return $notifications;
    }
    public function readed(){
        $notifications = auth()->user()
            ->readNotifications()
            ->latest()
            ->paginate(10);
        return $notifications;
    }
}
