<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductFavorite;
use App\Models\ProductFavoriteDetail;

class ProductFavoriteController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        }
    
        $userId = auth()->id();
        $favorite = ProductFavorite::with('items')->where('user_id', $userId)->first();
        if (!$favorite) {
            // Nếu không tìm thấy giỏ hàng, bạn có thể tạo một giỏ hàng mới hoặc xử lý theo nhu cầu của bạn
            $favorite = new ProductFavorite();
            $favorite->user_id = $userId;
            $favorite->save();
        }
        
        return view('favorites.index', compact('favorite'));
    }
    

    public function store(Request $request)
    {
        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
    
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Lấy ID của người dùng hiện tại
            $userId = Auth::id();
    
            // Tìm danh sách yêu thích của người dùng hoặc tạo mới nếu chưa có
            $favorite = ProductFavorite::firstOrCreate(['user_id' => $userId]);
    
            // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích của người dùng hay chưa
            $favoriteItem = ProductFavoriteDetail::where('favorite_id', $favorite->id)->where('product_id', $productId)->first();
    
            if (!$favoriteItem) {
                // Nếu sản phẩm chưa tồn tại trong danh sách yêu thích, thêm vào
                $favoriteItem = new ProductFavoriteDetail();
                $favoriteItem->favorite_id = $favorite->id;
                $favoriteItem->product_id = $productId;
                $favoriteItem->save();
    
                // Trả về thông báo thành công
                return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích.');
            } else {
                // Nếu sản phẩm đã tồn tại trong danh sách yêu thích, trả về thông báo lỗi
                return redirect()->back()->with('success', 'Sản phẩm đã tồn tại trong danh sách yêu thích.');
            }
        } else {
            // Redirect hoặc yêu cầu đăng nhập
            return redirect()->back('login')->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm khỏi danh sách yêu thích:');
        }
    }
    

    public function destroy($productId)
    {
        try {
            // Tìm và xóa sản phẩm yêu thích khỏi danh sách
            $favoriteItem = ProductFavoriteDetail::where('product_id', $productId)->delete();
    
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi danh sách yêu thích.');
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi xảy ra
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm khỏi danh sách yêu thích: ' . $e->getMessage());
        }
    }
    

}
