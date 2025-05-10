<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Interfaces\Services\NotificationServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{   
    public function __construct(protected NotificationServiceInterface $notificationService){
        
    }
    public function index()
    {
        $notifications=$this->notificationService->index();
        return $this->responsePagination(
            $notifications,
            NotificationResource::collection($notifications),
            __('message.notification.get'),
            
    );
    }

    // 2. O‘qilmagan notificationlar (paginated)
    public function unread()
    {
        $notifications=$this->unread();
    
        
        return $this->responsePagination(
            $notifications,
            NotificationResource::collection($notifications),
            __('message.notification.get'),
            
    );
    }

    // 3. O‘qilgan notificationlar (paginated)
    public function readed()
    {
        $notifications=$this->readed();
            return $this->responsePagination(
                $notifications,
                NotificationResource::collection($notifications),
                __('message.notification.get'),
        );
    }

    // 4. Show - Notificationni ko‘rish (va read qilish)
    public function show($id)
    {
        $notifications=$this->show($id);

        $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return $this->success(
            new NotificationResource($notification),
            __('message.notification.read'),
            200
        );
    }
}
