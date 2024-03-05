<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
   public function index()
   {
      $orders = Order::with('user')->latest()->paginate(10);
      return view('admin.order.index', compact('orders'));
   }
   
   public function show($id)
   {
      $order = Order::with('user', 'orderDetails.product.productImage')->findOrFail($id);
      return view('admin.order.show', compact('order'));
   }

}
