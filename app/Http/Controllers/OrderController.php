<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Checkout(Request $req)
{
    $orderData = [];

    foreach ($req->input('p_name') as $key => $productName) {
        $order = new Order(); 
        $order->order_id = 123456;
        $order->o_name = $productName;
        $order->o_price = $req->input('p_price')[$key];
        $order->p_qty = $req->input('p_qty')[$key];
        $order->p_path = $req->input('img')[$key];

        $orderData[] = $order->attributesToArray(); 
    }
    if (Order::insert($orderData)) {
        session()->forget('cart');
        return redirect('/Shop')->with('success', 'Checkout Successfully');
    }
}




}