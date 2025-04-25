<?php

namespace App\Http\Controllers;

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

    // Adminlarga notification yuborish
    $admins = User::where('role', 'admin')->get();
    foreach ($admins as $admin) {
        $admin->notify(new NewOrderNotification($order));
    }

    return response()->json(['message' => 'Buyurtma yaratildi'], 201);
}
}
