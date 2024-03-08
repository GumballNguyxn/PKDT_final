<?php

namespace App\Http\Controllers;
use App\Models\Product ;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // HAM DANG NHAP
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->where('product_categories.id', 1)
                    ->orderBy('created_at', 'desc')
                    ->select('products.*')
                    ->get();

        $products3 = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->where('product_categories.id', 3)
                    ->orderBy('created_at', 'desc')
                    ->select('products.*')->take(3)
                    ->get();
        $products5 = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->where('product_categories.id', 6)
                    ->orderBy('created_at', 'desc')
                    ->select('products.*')->take(3)
                    ->get();
        $productsbc = Product::join('product_comments', 'products.id', '=', 'product_comments.product_id')
    ->where('products.product_category_id', 1)
    ->select('products.*', Product::raw('AVG(product_comments.rating) as average_rating'))
    ->groupBy('products.id', 'products.brand_id', 'products.product_category_id', 'products.name', 'products.description', 'products.details', 'products.quantity', 'products.created_at', 'products.updated_at')
    ->orderByDesc('average_rating')
    ->take(5)
    ->get();
        $categories = ProductCategory::all();
        $brands = Brand::all();

        return view('home', compact('products','categories','brands','productsbc','products3','products5'));
    }
    public function store()
    {
        //return view('auth.login');
        return view('store');

    }
    public function ajaxHomeProductMoi(Request $request){
        $category = $request->input('category');
        // $products = Product::orderBy('created_at', 'desc')->get();

        $products = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->where('product_categories.id', $category)
                    ->orderBy('created_at', 'desc')
                    ->select('products.*')
                    ->get();
        $output ='';
        $output .='<div class="row">
        <div class="products-tabs" >
            <!-- tab -->
            <div id="tab1" class="tab-pane active">
                <div class="products-slick"  data-nav="#slick-nav-1">';
        foreach ($products as $item){
        $output .= '<div class="product">
            <div class="product-img">
                <img src="products_img/'. $item->productImage->get(0)->path .'" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">'. $item->productCategory->name .'</p>
                <h3 class="product-name"><a href="'.route('products.show',  $item->id).'">'. Str::limit($item->name, 40) .'</a></h3>' ;

                    $price = $item->productDetail->min('price');
                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                    $PriceX = number_format($price*1.3, 0, ',', '.');

                $output .= '<h4 class="product-price">'. $formattedPrice .'<del class="product-old-price">'. $PriceX .'</del></h4>
                <div class="product-rating">';
                $totalRating = 0;
            $totalComments = count($item->productComment);

            if ($totalComments > 0) {
                foreach ($item->productComment as $comment) {
                    $totalRating += $comment->rating;
                }

                $averageRating = round($totalRating / $totalComments, 1);
            } else {
                $averageRating = 0;
            }
            for ($i = 0; $i < $averageRating; $i++) {
                    $output .='<i class="fa fa-star"></i>';}
                $output .= '</div>
                <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào <br> DS yêu thích</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                </div>
            </div>
            <div class="add-to-cart">
            <form action="'.route('carts.store') .'" method="POST" class="add-to-cart-form">
            '. csrf_field() .'
                <input type="hidden" name="product_id" value="'.$item->id .'">
                <input type="hidden" name="price" value="'.$formattedPrice.'  ">
                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
                
                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
        </form>
            </div>
        </div>' ;
        }
        $output .='</div>
        <div id="slick-nav-1" class="products-slick-nav"></div>
    </div>
    <!-- /tab -->
</div>
</div>';
        echo $output;

    }
    public function ajaxHomeProductBanChay(Request $request){
        $category = $request->input('category');
        $products = Product::join('product_comments', 'products.id', '=', 'product_comments.product_id')
    ->where('products.product_category_id', $category)
    ->select('products.*', Product::raw('AVG(product_comments.rating) as average_rating'))
    ->groupBy('products.id', 'products.brand_id', 'products.product_category_id', 'products.name', 'products.description', 'products.details', 'products.quantity', 'products.created_at', 'products.updated_at')
    ->orderByDesc('average_rating')
    ->take(5)
    ->get();
        $productsdf = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
        ->where('product_categories.id', 1)
        ->orderBy('created_at', 'desc')
        ->select('products.*')
        ->get();
        // $products = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
        //             ->where('product_categories.id', $category)
        //             ->orderBy('created_at', 'desc')
        //             ->select('products.*')
        //             ->get();
        $output ='';
        $output .='<div class="row">
        <div class="products-tabs">
            <!-- tab -->
            <div id="tab2" class="tab-pane fade in active">
                <div class="products-slick" data-nav="#slick-nav-2">';
        foreach ($products as $item){
        $output .= '<div class="product">
            <div class="product-img">
                <img src="products_img/'. $item->productImage->get(0)->path .'" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">'. $item->productCategory->name .'</p>
                <h3 class="product-name"><a href="'.route('products.show',  $item->id).'">'. Str::limit($item->name, 40) .'</a></h3>' ;

                    $price = $item->productDetail->min('price');
                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                    $PriceX = number_format($price*1.3, 0, ',', '.');

                $output .= '<h4 class="product-price">'. $formattedPrice .'<del class="product-old-price">'. $PriceX .'</del></h4>
                <div class="product-rating">';
                $totalRating = 0;
            $totalComments = count($item->productComment);

            if ($totalComments > 0) {
                foreach ($item->productComment as $comment) {
                    $totalRating += $comment->rating;
                }

                $averageRating = round($totalRating / $totalComments, 1);
            } else {
                $averageRating = 0;
            }
            for ($i = 0; $i < $averageRating; $i++) {
                    $output .='<i class="fa fa-star"></i>';}
                $output .= '</div>
                <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào <br> DS yêu thích</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                </div>
            </div>
            <div class="add-to-cart">
            <form action="'.route('carts.store') .'" method="POST" class="add-to-cart-form">
            '. csrf_field() .'
                <input type="hidden" name="product_id" value="'.$item->id .'">
                <input type="hidden" name="price" value="'.$formattedPrice.'  ">
                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
                
                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
        </form>
            </div>
        </div>' ;
        }
        $output .='</div>
        <div id="slick-nav-2" class="products-slick-nav"></div>
    </div>
    <!-- /tab -->
</div>
</div>';
$outputdf ='';
        $outputdf .='<div class="row">
        <div class="products-tabs" >
            <!-- tab -->
            <div id="tab1" class="tab-pane active">
                <div class="products-slick"  data-nav="#slick-nav-1">';
        foreach ($productsdf as $item){
        $outputdf .= '<div class="product">
            <div class="product-img">
                <img src="products_img/'. $item->productImage->get(0)->path .'" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">'. $item->productCategory->name .'</p>
                <h3 class="product-name"><a href="'.route('products.show',  $item->id).'">'. Str::limit($item->name, 40) .'</a></h3>' ;

                    $price = $item->productDetail->min('price');
                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                    $PriceX = number_format($price*1.3, 0, ',', '.');

                $outputdf .= '<h4 class="product-price">'. $formattedPrice .'<del class="product-old-price">'. $PriceX .'</del></h4>
                <div class="product-rating">';
                $totalRating = 0;
            $totalComments = count($item->productComment);

            if ($totalComments > 0) {
                foreach ($item->productComment as $comment) {
                    $totalRating += $comment->rating;
                }

                $averageRating = round($totalRating / $totalComments, 1);
            } else {
                $averageRating = 0;
            }
            for ($i = 0; $i < $averageRating; $i++) {
                    $outputdf .='<i class="fa fa-star"></i>';}
                $outputdf .= '</div>
                <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào <br> DS yêu thích</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                </div>
            </div>
            <div class="add-to-cart">
            <form action="'.route('carts.store') .'" method="POST" class="add-to-cart-form">
            '. csrf_field() .'
                <input type="hidden" name="product_id" value="'.$item->id .'">
                <input type="hidden" name="price" value="'.$formattedPrice.'  ">
                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
                
                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
            </form>
            </div>
        </div>' ;
        }
        $outputdf .='</div>
        <div id="slick-nav-1" class="products-slick-nav"></div>
    </div>
    <!-- /tab -->
</div>
</div>';

return response()->json(['output' => $output, 'outputdf' => $outputdf]);

    }
    public function profile(User $user)
    {
        return view('auth.profile');
    }

}
