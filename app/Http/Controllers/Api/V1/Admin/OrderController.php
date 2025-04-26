<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
{
    $order = Order::create([
        'book_id' => $request->book_id,
        'user_id' => auth()->id(),
        'address' => $request->address,
        'stock' => $request->stock,
    ]);

    $admins = User::where('role', 'admin')->get();
    foreach ($admins as $admin) {
        $admin->notify(new NewOrderNotification($order));
    }

    return $this->success($order, __('message.order.store_success'), 201);
}
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
    return $this->responsePagination([
        OrderResource::collection($orders),
        $orders->items(),
        __('message.order.index_success'),
        200
    ]);
 }
}