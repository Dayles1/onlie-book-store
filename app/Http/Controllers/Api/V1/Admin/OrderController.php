<?php

namespace App\Http\Controllers\Api\V1\Admin;

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

 public function index(){
    $user= auth()->user();
    $orders = $user->orders()->with('book')->paginate(10);
    if($user->role == 'admin'){
        $orders = Order::with('book','user')->paginate(10);
    }
    if($orders->isEmpty()){
        return $this->error(
            __('message.order.index_empty'),
            404
        );
    }
           return $this->responsePagination(
            $orders,
            OrderResource::collection($orders),
            __('message.order.index_success')
        );

 }

 public function edit(OrderUpdateRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->only([ 'status']));

        return $this->success(new OrderResource($order), __('message.order.update_success'));
    }
}