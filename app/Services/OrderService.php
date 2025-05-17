<?php

namespace App\Services;

use App\Interfaces\Repositories\OrderRepositoryInterface;
use App\Models\User;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use App\Interfaces\Services\OrderServiceInterface;

class OrderService extends BaseService implements OrderServiceInterface
{
    public function __construct(protected OrderRepositoryInterface $orderRepository){}

    public function store($request)
    {
        $order = $this->orderRepository->store($request);
        $notify= $this->orderRepository->sendNotify($order);
        return $order;
    }
    public function index()
    {   
         $user= auth()->user();
        
        if($user->role == 'admin'){
            $orders=$this->orderRepository->indexAdmin();
        }
        else{
            $orders = $this->orderRepository->index($user);
        }
  
    return $orders;
        
    }
 
    public function destroy($id)
    {
            $user = auth()->user();
        $order = Order::findOrFail($id);

        if ($user->id !== $order->user_id && !$user->role === 'admin') {
            return ['status'=>'error'];
        }

        $order->delete();
            return ['status'=>'success'];

    }
     public function update($request, $id){
         $order = Order::findOrFail($id);
        $order->update($request->only([ 'status']));
        return $order;
     }
    
}
