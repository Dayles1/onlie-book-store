<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Interfaces\Services\OrderServiceInterface;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    
   public function __construct(protected OrderServiceInterface $orderService){}
    public function store(OrderStoreRequest $request)
    {
        $order = $this->orderService->store($request);
  

        return $this->success(new OrderResource($order), __('message.order.create_success'), 201);
    }

    /**
     * List orders (user sees own orders, admin sees all).
     */
    public function index()
    {   
        $orders= $this->orderService->index();
    
           return $this->responsePagination(
            $orders,
            OrderResource::collection($orders),
            __('message.order.index_success')
        );
    }


    public function destroy($id)
    {
        $user = auth()->user();
        $order = Order::findOrFail($id);

        if ($user->id !== $order->user_id && !$user->role === 'admin') {
            return $this->error(__('message.order.delete_error'), 403);
        }

        $order->delete();

        return $this->success([], __('message.order.delete_success'));
    }
}