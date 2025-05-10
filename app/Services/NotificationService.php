<?php

namespace App\Services;

use App\Interfaces\Services\NotificationServiceInterface;

class NotificationService extends BaseService implements NotificationServiceInterface
{
    public function index()
    {
         $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);
         
            return $notifications;
    }
    public function show($id)
    {

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
