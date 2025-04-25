<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    public function store(Request $request)
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

    return response()->json(['message' => 'Buyurtma yaratildi'], 201);
}
 public function index(){
    $user= auth()->user();
    $orders = $user->orders()->with('book')->paginate(10);
    if($user->role == 'admin'){
        $orders = Order::with('book')->paginate(10);
    }
    if($orders->isEmpty()){
        return response()->json(['message' => 'Buyurtmalar topilmadi'], 404);
    }
    return $this->responsePagination([
        OrderResource::collection($orders),
        $orders->items(),
        __('message.order.index_success'),
        200
    ]);
 }
}