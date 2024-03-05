<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductDetail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $cart = Cart::with('items')->where('user_id', $userId)->first();
        if (!$cart) {
            // Nếu không tìm thấy giỏ hàng, bạn có thể tạo một giỏ hàng mới hoặc xử lý theo nhu cầu của bạn
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();
        }
    

        return view('carts.cart', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Lấy thông tin sản phẩm từ request
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $price = $request->input('price');

    // Tìm thông tin sản phẩm
    $product = Product::with('productImage', 'productDetail', 'productComment')->findOrFail($productId);

    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (Auth::check()) {
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, tạo một cart item mới
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $price = str_replace('.', '', $price);

            // Chuyển đổi chuỗi thành số
            $price = intval($price);
            $cartItem->price = $price ;
            $cartItem->save();
        }

        // Redirect hoặc trả về thông báo thành công
        return response()->json(['success' => true]);
    } else {
        // Redirect hoặc yêu cầu đăng nhập
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
    }

}

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
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
    
        return redirect()->route('carts.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

}
