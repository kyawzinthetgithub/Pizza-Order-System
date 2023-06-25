<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //direct order list
    public function orderList()
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.order.list', compact('orders'));
    }

    //sort status with ajax
    public function changeStatus(Request $request)
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc');

        if ($request->orderStatus == null) {
            $orders = $orders->get();
        } else {
            $orders = $orders->orWhere('orders.status', $request->orderStatus)->get();
        }
        return view('admin.order.list', compact('orders'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }

    //order list info
    public function listInfo($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();

        $orderLists = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->where('order_code', $orderCode)
            ->get();
        return view('admin.order.productList', compact('orderLists', 'order'));
    }
}