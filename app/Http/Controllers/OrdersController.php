<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index(): view
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.orders', get_defined_vars());
    }

    public function get_by_status($status): view
    {
        $orders = Order::with('user')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.orders', get_defined_vars());
    }

    public function order_update(Order $order, $status): view
    {
        $order->update([
            'status' => $status,
        ]);

        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.orders', get_defined_vars());
    }
}
