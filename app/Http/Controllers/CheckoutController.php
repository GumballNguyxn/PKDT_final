<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::with('items')->where('user_id', $user->id)->first();

        $shippingFee = 30000;

        // Trả về view checkout với thông tin giỏ hàng
        return view('checkouts.checkout', compact('cart', 'shippingFee'));
    }
    

    public function placeorder(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::with('items')->where('user_id', $user->id)->first();
    
        $cartItems = $cart->items;
        $calculatedTotalPrice = 0;
    
        foreach ($cartItems as $item) {
            $calculatedTotalPrice += $item->price * $item->quantity;
        }
    
        $shippingFee = 30000;
    
        $order = new Order();
        $order->user_id = $user->id;
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone_number = $request->input('phone_number');
        $order->address = $request->input('address');
        $order->total_price = $calculatedTotalPrice + $shippingFee; // Add shipping fee to total price
    
        $order->save();
    
        foreach ($cart->items as $item) {
            $orderDetail = new OrderDetail([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        
            // Lấy thông tin màu sắc từ bảng product_details
            $color = $item->product->productDetail->first()->color;
        
            // Tiếp tục lưu vào CSDL
            $orderDetail->color = $color;
            $orderDetail->save();
        }
        
    
        // Clear the cart after placing the order
        $cart->items()->delete();
        
        // Chuyển hướng đến trang thông tin đơn hàng thành công
        return redirect()->route('order.success', ['order' => $order]);

      
    }
    

    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}