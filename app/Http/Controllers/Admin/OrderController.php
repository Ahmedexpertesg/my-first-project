<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
   public function AllOrders()
{
    // Ensure you are eager loading 'items.product' for the total calculation
    $allOrders = Order::with('items.product', 'user')->get(); // Added 'user' for customer name if applicable

    return view('admin.order.index', compact('allOrders'));
}

    public function show(Order $order) // Laravel's Route Model Binding will inject the Order instance
    {
        // Eager load the order items AND their associated products
        // This prevents N+1 queries when displaying items and product names
        $order->load('items.product', 'user'); // Also load the user (customer) if you linked it

        return view('admin.order.show', compact('order'));
    }
}
