<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orderSuccess(Order $order)
    {
        return view('orders.success', compact('order'));
    }
}
