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
use App\Interfaces\Services\OrderServiceInterface;

class OrderController extends Controller
{
     public function __construct(protected OrderServiceInterface $orderService){}
   

   

 public function update(OrderUpdateRequest $request, $id)
    {
        $order=$this->orderService->update($request->all(),$id);
        return $this->success(new OrderResource($order), __('message.order.update_success'));
    }
}