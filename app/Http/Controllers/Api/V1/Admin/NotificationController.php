<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // 1. Barcha notificationlar (paginated)
    public function index(Request $request)
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);
            if ($notifications->isEmpty()) {
                return $this->error(
                    __('message.notification.empty'),
                    404
                );
            }
        return $this->responsePagination(
            $notifications,
            $notifications,
            __('message.notification.get'),
            
    );
    }

    // 2. O‘qilmagan notificationlar (paginated)
    public function unread(Request $request)
    {
        $notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->paginate(10);
        if ($notifications->isEmpty()) {
            return $this->error(
                __('message.notification.empty'),
                404
            );
        }
        return $this->responsePagination(
            $notifications,
            $notifications,
            __('message.notification.get'),
            
    );
    }

    // 3. O‘qilgan notificationlar (paginated)
    public function readed(Request $request)
    {
        $notifications = auth()->user()
            ->readNotifications()
            ->latest()
            ->paginate(10);
            if ($notifications->isEmpty()) {
                return $this->error(
                    __('message.notification.empty'),
                    404
                );
            }
            return $this->responsePagination(
                $notifications,
                $notifications,
                __('message.notification.get'),
                
        );
    }

    // 4. Show - Notificationni ko‘rish (va read qilish)
    public function show($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return $this->success(
            $notification,
            __('message.notification.read'),
            200
        );
    }
}
