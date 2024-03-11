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
    // Validate incoming requests
    $request->validate([
        'brand_id' => 'required',
        'product_category_id' => 'required',
        'name' => 'required',
        'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'description' => 'required',
        'details' => 'required',
        'colors' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    // Create product
    $product = Product::create([
        'brand_id' => $request->brand_id,
        'product_category_id' => $request->product_category_id,
        'name' => $request->name,
        'description' => $request->description,
        'details' => $request->details,
        'quantity' => $request->quantity,
    ]);

    // Handle product images
    if ($request->hasfile('product_image')) {
        foreach ($request->file('product_image') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('products_img'), $imageName);

            // Save image to database
            $product->productImage()->create([
                'path' => $imageName,
            ]);
        }
    }

    // Handle product details (colors)
    $colors = explode(',', $request->input('colors'));
    foreach ($colors as $color) {
        // Save color to database
        $product->productDetail()->create([
            'color' => $color,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    }

    // Calculate total quantity
    $totalQuantity = ProductDetail::where('product_id', $product->id)->sum('quantity');
    $product->update(['quantity' => $totalQuantity]);

    // Redirect or respond as needed
    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
}

    

    public function show(string $id)
    {
        //$totalQuantity = ProductDetail::where('product_id', $product->id)->sum('quantity');
        //$product->update(['quantity' => $totalQuantity]);
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
    
    
    

    public function destroy($productId, $productDetailId)
    {
        try {
            $productDetail = ProductDetail::where('product_id', $productId)->findOrFail($productDetailId);
            $productDetail->delete();
    
            // Nếu muốn xóa sản phẩm khi không còn chi tiết sản phẩm nào liên quan
            // Ta kiểm tra xem sản phẩm còn chi tiết sản phẩm nào không
            if (ProductDetail::where('product_id', $productId)->count() == 0) {
                $product = Product::findOrFail($productId);
                $product->delete();
            }
    
            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm và chi tiết sản phẩm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm: ' . $e->getMessage());
        }
    }
    

    public function showInAdmin(Request $request)
    {
        $query = Product::with('productImage', 'productDetail', 'productComment')
                       ->orderBy('created_at', 'desc'); // Sắp xếp sản phẩm theo thứ tự giảm dần của created_at
    
        // Xử lý tìm kiếm
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            // Lọc sản phẩm theo ID hoặc tên sản phẩm
            $query->where(function ($query) use ($searchTerm) {
                $query->where('id', 'like', "%{$searchTerm}%")
                      ->orWhere('name', 'like', "%{$searchTerm}%");
            });
        }
    
        $numberOfRecord = $query->count();
        $perPage = 10; // Hiển thị 10 sản phẩm trên mỗi trang
        $numberOfPage = $numberOfRecord % $perPage == 0 ?
            (int) ($numberOfRecord / $perPage) : (int) ($numberOfRecord / $perPage) + 1;
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
    
        $products = $query->skip(($pageIndex - 1) * $perPage)
                          ->take($perPage)
                          ->get();
    
        // Trả về view hiển thị danh sách sản phẩm trong trang admin với thông tin phân trang
        return view('admin.products.index', compact('products', 'pageIndex', 'numberOfPage'));
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
                'newImage' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
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

