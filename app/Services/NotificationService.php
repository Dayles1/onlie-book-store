<?php

namespace App\Services;

use App\Interfaces\Repositories\NotificationRepositoryInterface;
use App\Interfaces\Services\NotificationServiceInterface;

class NotificationService extends BaseService implements NotificationServiceInterface
{
    public function __construct(protected NotificationRepositoryInterface $notificationRepository){}

    public function index()
    {
        $notifications=$this->notificationRepository->index();
            return $notifications;
    }
    public function show($id)
    {
        $notification=$this->notificationRepository->show($id);
        return $notification;

    }
    public function unread(){
        $notifications= $this->notificationRepository->unread();
          
      return $notifications;
    }
       public function readed(){

        $notifications= $this->notificationRepository->readed();
            return $notifications;

    }
}
