<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use view;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::get();
        return view('admin.order.list', compact('orders'));
    }

    public function changeStatus(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->status = $request->status;
        $order->update();
        return response()->json([
            'status' => 'success',
            'message' => 'Status change success',
        ]);
    }

    public function detail($orderCode)
    {
        $orderDetail = OrderList::orderDetail($orderCode);
        $order = Order::where('order_code', $orderCode)->first();
        return view('admin.order.detail', compact('orderDetail', 'order'));
    }
}
