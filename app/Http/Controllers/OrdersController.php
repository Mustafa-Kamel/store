<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index($type = '') {
        switch ($type) {
            case 'pending':
                $orders = Order::where('delivered', 0)->get();
                break;

            case 'delivered':
                $orders = Order::where('delivered', 1)->get();
                break;
                
            default:
                $orders = Order::all();
                break;
        }

        return view('admin.orders', compact('orders'));
    }
    
    public function deliver(Order $order) {
        $order->delivered = 1;
        $order->save();
        return redirect()->back();
    }

    public function unDeliver(Order $order) {
        $order->delivered = 0;
        $order->save();
        return redirect()->back();
    }
}
