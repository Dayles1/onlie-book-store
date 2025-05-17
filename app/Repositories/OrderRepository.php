<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use App\Interfaces\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function store($request){
           $order = Order::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'address' => $request->address,
            'stock' => $request->stock,
           
        ]);
        return $order;
    }
    public function sendNotify($order){
         $admins = User::where('role', 'admin')->get(); 
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }
    }
    public function index($user){
            $orders = $user->orders()->with('book')->paginate(10);
        return $orders;
    }
    public function indexAdmin(){
            $orders = Order::with('book','user')->paginate(10);
        return $orders;
    }
    public function find($id){
        $order = Order::findOrFail($id);
        return $order;
    }

    public function destroy($order){
            $order->delete();
            

    }
    public function update($request, $order){
        $order->update($request->only([ 'status']));

    }
}
