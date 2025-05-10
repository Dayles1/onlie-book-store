<?php

namespace App\Http\Controllers\Api\V1\User;

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
    

    /**
     * Store a new order.
     */
    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'address' => $request->address,
            'stock' => $request->stock,
            'status' => 'pending', // Default status
        ]);

        // Notify admins
        $admins = User::where('role', 'admin')->get(); 
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }

        return $this->success(new OrderResource($order), __('message.order.create_success'), 201);
    }

    /**
     * List orders (user sees own orders, admin sees all).
     */
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('book')->paginate(10);

        if ($user->role === 'admin') {
            $orders = Order::with(['book', 'user'])->paginate(10);
        }

        if ($orders->isEmpty()) {
            return $this->error(__('message.order.index_empty'), 404);
        }

        return $this->responsePagination(
            $orders,
            OrderResource::collection($orders),
            __('message.order.index_success')
        );
    }

    /**
     * Edit an order (admin only).
     */
    

    /**
     * Delete an order (for all users).
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $order = Order::findOrFail($id);

        if ($user->id !== $order->user_id && !$user->role === 'admin') {
            return $this->error(__('message.order.delete_error'), 403);
        }

        $order->delete();

        return $this->success([], __('message.order.delete_success'));
    }
}