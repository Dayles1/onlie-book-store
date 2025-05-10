<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use App\Interfaces\Services\OrderServiceInterface;

class OrderService extends BaseService implements OrderServiceInterface
{

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
    public function edit($request, $id)
    {
     
    }
    public function destroy($id)
    {
        
    }
     public function adminEdit($request, $id){

     }
    
}
