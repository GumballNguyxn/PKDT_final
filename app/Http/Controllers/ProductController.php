<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\ProductDetail;
use App\Models\ProductFavorite;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $numberOfRecord = Product::count();
        $perPage = 3;
        $numberOfPage = $numberOfRecord % $perPage == 0 ?
            (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
        $pageIndex = 1;
        if ($request->has('pageIndex')) {
            $pageIndex = $request->input('pageIndex');
        }
        if ($pageIndex < 1) {
            $pageIndex = 1;
        }
        if ($pageIndex > $numberOfPage) {
            $pageIndex = $numberOfPage;
        }
        $products = Product::orderBy('id', 'desc')->skip(($pageIndex - 1) * $perPage)
            ->take($perPage)->get();
        $topRatedProducts = ProductComment::where('rating', 5)
            ->get();
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('products.index', compact('products', 'categories', 'brands', 'topRatedProducts', 'pageIndex', 'numberOfPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('productImage', 'productDetail', 'productComment','productBrand')->get();
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $productDetails = ProductDetail::all();
        return view('admin.products.create', compact('products', 'brands', 'categories', 'productDetails'));
    }
    
    public function store(Request $request)
    {
        $validatedData =  $request->validate( [
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
            'product_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = Product::create($request->only([
            'name',
            'product_category_id', 
            'brand_id', 
            'color', 
            'price', 
            'quantity', 
            'description', 
            'details'
        ]));
        $image = $request->file('product_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('products_img'), $imageName);

        ProductDetail::create([
            'product_id' => $product->id,
            'color' => $request->input('color'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ]);
        
        ProductImage::create([
            'product_id'=>$product->id,
            'path'=>$imageName
        ]);

    
        $totalQuantity = ProductDetail::where('product_id', $product->id)->sum('quantity');
        $product->update(['quantity' => $totalQuantity]);
    
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function show(string $id)
    {
        $product = Product::with('productImage', 'productDetail', 'productComment')->findOrFail($id);
        $commentsPerPage = 3;
        $comments = $product->productComment()->paginate($commentsPerPage);
        $categoryId = $product->product_category_id;
        $relatedProducts = Product::where('product_category_id', $categoryId)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Lấy ID của người dùng hiện tại
            $userId = Auth::id();
            // Kiểm tra xem người dùng đã từng mua sản phẩm này hay không
            $userBoughtProduct = $product->orders()->where('user_id', $userId)->exists();

        } else {
            // Nếu người dùng chưa đăng nhập, không cần kiểm tra
            $userBoughtProduct = false;

        }
        // Truyền dữ liệu vào view
        return view('products.show', compact('product', 'comments', 'relatedProducts', 'userBoughtProduct'));
    }


    public function edit()
    {

    }
    
    
    public function update()
    {

    }
    
    
    

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            
            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm: ' . $e->getMessage());
        }
    }

    public function showInAdmin()
    {
        // Lấy 10 sản phẩm đầu tiên, cùng với các thông tin liên quan
        $products = Product::with('productImage', 'productDetail', 'productComment')
                            ->take(10)
                            ->get();
    
        // Trả về view hiển thị danh sách sản phẩm trong trang admin
        return view('admin.products.index', compact('products'));
    }

    public function showProductDetail($productId, $productDetailId)
    {
        // Lấy thông tin sản phẩm từ ID
        $product = Product::with('productImage', 'productDetail', 'productComment')->findOrFail($productId);
        $productDetail = ProductDetail::findOrFail($productDetailId);
        
        // Lấy thông tin của hãng từ sản phẩm
        $brand = $product->productBrand;
    
        // Trả về view hiển thị chi tiết sản phẩm
        return view('admin.products.showDetail', compact('product', 'productDetail', 'brand'));
    }
    



    public function editProduct($productId, $productDetailId) {
        // Lấy thông tin sản phẩm dựa trên productId
        $product = Product::findOrFail($productId);
        $productDetail = ProductDetail::findOrFail($productDetailId);     
        // Lấy danh sách các hãng
        $brands = Brand::all();
        // Lấy danh sách các danh mục sản phẩm
        $categories = ProductCategory::all();
        // Lấy hình ảnh sản phẩm (nếu có)
        $productImage = ProductImage::where('product_id', $productId)->first();
        // Truyền các biến vào view
        return view('admin.products.edit', compact('product', 'productDetail', 'brands', 'categories', 'productImage'));
    }





    public function updateProduct(Request $request, string $productId, string $productDetailId){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
        ]);
    
        try {
            // Find the product by its ID
            $product = Product::findOrFail($productId);
            
            // Update the product attributes with the validated data
            $product->update([
                'name' => $request->input('name'),
                'product_category_id' => $request->input('product_category_id'),
                'brand_id' => $request->input('brand_id'),
            ]);
    
            // Find the product detail by its ID
            $productDetail = ProductDetail::findOrFail($productDetailId);
    
            // Update the product detail attributes with the validated data
            $productDetail->update([
                'color' => $request->input('color'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'details' => $request->input('details'),
            ]);
    
            // Calculate total quantity of the product from product details
            $totalQuantity = ProductDetail::where('product_id', $productId)->sum('quantity');
    
            // Update product quantity with the calculated total quantity
            $product->update(['quantity' => $totalQuantity]);

    
            // Redirect back with success message
           // Redirect back with success message
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');

        } catch (\Exception $e) {
            // Redirect back with error message if any exception occurs
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
        }
    }


    public function updateImage(Request $request, $productId, $productImageId) {
        // Kiểm tra xem có tệp được gửi lên không
        if ($request->hasFile('newImage')) {
            // Validate request data
            $validatedData = $request->validate([
                'newImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Tìm kiếm hình ảnh cần cập nhật
            $productImage = ProductImage::where('product_id', $productId)
                ->where('id', $productImageId)
                ->firstOrFail();
    
            // Di chuyển và lưu hình ảnh mới
            $imageName = time() . '_' . uniqid() . '.' . $request->file('newImage')->extension();
            $request->file('newImage')->move(public_path('products_img'), $imageName);
    
            // Lưu đường dẫn hình ảnh mới vào cơ sở dữ liệu
            $productImage->update([
                'path' => $imageName,
            ]);
    
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật ảnh sản phẩm thành công!');
        } else {
            // Trường hợp không có tệp được gửi lên
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một tệp ảnh.');
        }
    }
}

