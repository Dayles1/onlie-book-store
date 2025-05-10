<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Notifications\NewOrderNotification;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
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
}
