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
        return $order;
    }
    public function index()
    {   
         $user= auth()->user();
    
        if($user->role == 'admin'){
            $orders = Order::with('book','user')->paginate(10);
        }
        else{
            $orders = $user->orders()->with('book')->paginate(10);
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
