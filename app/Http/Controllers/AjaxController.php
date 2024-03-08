<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    //
    public function getProducts(Request $request)
    {
        $cate_id = $request->input('keycate_id');
        $array_cate_id = explode(',', $cate_id);
        $brand_id = $request->input('keybrand_id');
        $array_brand_id = explode(',', $brand_id);

        $price = $request->input('pricex');
        $sx = $request->input('selectedValue');
        if ($price != 0) {
            // Tiếp tục xử lý
            if ($price == 9) {
                $min = 0;
                $max = 9000000000;
            }
            if ($price == 1) {
                $min = 0;
                $max = 2000000;
            }

            if ($price == 2) {
                $min = 2000000;
                $max = 4000000;
            }
            if ($price == 3) {
                $min = 4000000;
                $max = 7000000;
            }
            if ($price == 4) {
                $min = 7000000;
                $max = 70000000;
            }

            if ($array_cate_id[0] == "" && $array_brand_id[0] == "") {
                $numberOfRecord = Product::whereHas('productDetail', function ($query) use ($min, $max) {
                    $query->whereBetween('price', [$min, $max]);
                })
                    ->count();

                $perPage = 6;
                $numberOfPage = $numberOfRecord % $perPage == 0 ?
                    (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                $pageIndex = 1;
                if ($request->has('pageIndex'))
                    $pageIndex = $request->input('pageIndex');
                if ($pageIndex < 1) $pageIndex = 1;
                if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
                if ($sx == 0)
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->whereBetween('product_details.price', [$min, $max])
                        ->orderBy('product_details.price', 'asc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
                else
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->whereBetween('product_details.price', [$min, $max])
                        ->orderBy('product_details.price', 'desc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
            } else {
                if ($array_cate_id[0] != "" && $array_brand_id[0] != "") {
                    $numberOfRecord = Product::whereIn('product_category_id', $array_cate_id)
                        ->WhereIn('brand_id', $array_brand_id)
                        ->whereHas('productDetail', function ($query) use ($min, $max) {
                            $query->whereBetween('price', [$min, $max]);
                        })
                        ->count();

                    $perPage = 6;
                    $numberOfPage = $numberOfRecord % $perPage == 0 ?
                        (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                    $pageIndex = 1;
                    if ($request->has('pageIndex'))
                        $pageIndex = $request->input('pageIndex');
                    if ($pageIndex < 1) $pageIndex = 1;
                    if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
                    if ($sx == 0)
                        $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                            ->whereIn('products.product_category_id', $array_cate_id)
                            ->whereIn('products.brand_id', $array_brand_id)
                            ->whereBetween('product_details.price', [$min, $max])
                            ->orderBy('product_details.price', 'asc')
                            ->skip(($pageIndex - 1) * $perPage)
                            ->take($perPage)->select('products.*')
                            ->get();
                    else
                        $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                            ->whereIn('products.product_category_id', $array_cate_id)
                            ->whereIn('products.brand_id', $array_brand_id)
                            ->whereBetween('product_details.price', [$min, $max])
                            ->orderBy('product_details.price', 'desc')
                            ->skip(($pageIndex - 1) * $perPage)
                            ->take($perPage)->select('products.*')
                            ->get();
                } else {
                    if ($array_brand_id[0] != "" && $array_cate_id[0] == "") {
                        $numberOfRecord = Product::WhereIn('brand_id', $array_brand_id)
                            ->whereHas('productDetail', function ($query) use ($min, $max) {
                                $query->whereBetween('price', [$min, $max]);
                            })
                            ->count();

                        $perPage = 6;
                        $numberOfPage = $numberOfRecord % $perPage == 0 ?
                            (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                        $pageIndex = 1;
                        if ($request->has('pageIndex'))
                            $pageIndex = $request->input('pageIndex');
                        if ($pageIndex < 1) $pageIndex = 1;
                        if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
                        if ($sx == 0)
                            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                                ->whereIn('products.brand_id', $array_brand_id)
                                ->whereBetween('product_details.price', [$min, $max])
                                ->orderBy('product_details.price', 'asc')
                                ->skip(($pageIndex - 1) * $perPage)
                                ->take($perPage)->select('products.*')
                                ->get();
                        else
                            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                                ->whereIn('products.brand_id', $array_brand_id)
                                ->whereBetween('product_details.price', [$min, $max])
                                ->orderBy('product_details.price', 'desc')
                                ->skip(($pageIndex - 1) * $perPage)
                                ->take($perPage)->select('products.*')
                                ->get();
                    } else {
                        if ($array_brand_id[0] == "" && $array_cate_id[0] != "") {

                            $numberOfRecord = Product::whereIn('product_category_id', $array_cate_id)
                                ->whereHas('productDetail', function ($query) use ($min, $max) {
                                    $query->whereBetween('price', [$min, $max]);
                                })
                                ->count();

                            $perPage = 6;
                            $numberOfPage = $numberOfRecord % $perPage == 0 ?
                                (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                            $pageIndex = 1;
                            if ($request->has('pageIndex'))
                                $pageIndex = $request->input('pageIndex');
                            if ($pageIndex < 1) $pageIndex = 1;
                            if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;

                            if ($sx == 0)
                                $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                                    ->whereIn('products.product_category_id', $array_cate_id)
                                    ->whereBetween('product_details.price', [$min, $max])
                                    ->orderBy('product_details.price', 'asc')
                                    ->skip(($pageIndex - 1) * $perPage)
                                    ->take($perPage)->select('products.*')
                                    ->get();
                            else
                                $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                                    ->whereIn('products.product_category_id', $array_cate_id)
                                    ->whereBetween('product_details.price', [$min, $max])
                                    ->orderBy('product_details.price', 'desc')
                                    ->skip(($pageIndex - 1) * $perPage)
                                    ->take($perPage)->select('products.*')
                                    ->get();
                        }
                    }
                }
            }
        } else {

            if ($array_cate_id[0] != "" && $array_brand_id[0] != "") {


                $numberOfRecord = Product::whereIn('product_category_id', $array_cate_id)
                    ->WhereIn('brand_id', $array_brand_id)->count();

                $perPage = 6;
                $numberOfPage = $numberOfRecord % $perPage == 0 ?
                    (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                $pageIndex = 1;
                if ($request->has('pageIndex'))
                    $pageIndex = $request->input('pageIndex');
                if ($pageIndex < 1) $pageIndex = 1;
                if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;

                if ($sx == 0)
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->whereIn('products.product_category_id', $array_cate_id)
                        ->whereIn('products.brand_id', $array_brand_id)
                        ->orderBy('product_details.price', 'asc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
                else
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->whereIn('products.product_category_id', $array_cate_id)
                        ->whereIn('products.brand_id', $array_brand_id)
                        ->orderBy('product_details.price', 'desc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
            } else {
                if ($array_cate_id[0] != "" || $array_brand_id[0] != "") {
                    $numberOfRecord = Product::whereIn('product_category_id', $array_cate_id)
                        ->orWhereIn('brand_id', $array_brand_id)->count();

                    $perPage = 6;
                    $numberOfPage = $numberOfRecord % $perPage == 0 ?
                        (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
                    $pageIndex = 1;
                    if ($request->has('pageIndex'))
                        $pageIndex = $request->input('pageIndex');
                    if ($pageIndex < 1) $pageIndex = 1;
                    if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;

                    if ($sx == 0)
                        $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                            ->whereIn('products.product_category_id', $array_cate_id)
                            ->orwhereIn('products.brand_id', $array_brand_id)
                            ->orderBy('product_details.price', 'asc')
                            ->skip(($pageIndex - 1) * $perPage)
                            ->take($perPage)->select('products.*')
                            ->get();
                    else
                        $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                            ->whereIn('products.product_category_id', $array_cate_id)
                            ->orwhereIn('products.brand_id', $array_brand_id)
                            ->orderBy('product_details.price', 'desc')
                            ->skip(($pageIndex - 1) * $perPage)
                            ->take($perPage)->select('products.*')
                            ->get();
                }
            }
        }










        // $products = Product::whereIn('product_category_id', $array_cate_id)->WhereIn('brand_id', $array_brand_id)->get();
        $output = '';
        $output .= '
    <div id="showProduct" class="row">';
        foreach ($products as $item) {
            $output .= '<div class="col-md-4 col-xs-6">
        <div class="product">
            <div class="product-img">
                <img src="products_img/' . $item->productImage->first()->path . '" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">' . $item->productCategory->name . '</p>
                <h3 class="product-name"><a href="' . route("products.show", $item->id) . '">' . Str::limit($item->name, 40) . '</a></h3>';


            $price = $item->productDetail->min('price');
            $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
            $PriceX = number_format($price * 1.3, 0, ',', '.');
            $output .= '<h4 class="product-price">' . $formattedPrice . ' VND<del class="product-old-price">' . $PriceX . '</del></h4> <!-- Thêm đơn vị tiền tệ -->
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
                $output .= '<i class="fa fa-star"></i>';
            }
            $output .= '</div>
        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem chi tiết</span></button>
        </div>
    </div>
    <div class="add-to-cart">
    <form action="'. route('carts.store') .'" method="POST" class="add-to-cart-form">
    '. csrf_field() .'
        <input type="hidden" name="product_id" value="'. $item->id .'">
        <input type="hidden" name="price" value="'. $formattedPrice .'">
        <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
        
        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
    </form>
    </div>
</div>
</div>';
        }

        $output .= '</div>
    <div class="store-filter clearfix">
    <span class="store-qty">Sản phẩm</span>
    <ul class="store-pagination">';
        for ($i = 1; $i <= $numberOfPage; $i++) {
            if ($i == $pageIndex)
                $output .= '<li href="' . route('products.index', ['pageIndex' => $i]) . '" class="pa active">' . $i . '</li>';
            else
                // $output .= '<li><a href="'. route('products.index',['pageIndex' => $i]) .'" class="pa">'. $i .'</a></li>';
                $output .= '<li onclick="handlePageClick(' . $i . ')" class="pa">' . $i . '</li>';
        }
        $output .= '
    </ul>
</div>';



        // Trả về view và truyền dữ liệu JSON
        // return view('products.index')->with('jsonData', json_encode($data));
        // return response()->json($data);
        echo $output;
    }

    public function phanTrang(Request $request)
    {
        $keySearch = $request->input('searchTerm');
        $sx = $request->input('selectedValue');

        if ($keySearch != '') {
            $numberOfRecord = Product::where('name', 'like', '%' . $keySearch . '%')->count();
            $perPage = 6;
            $numberOfPage = $numberOfRecord % $perPage == 0 ?
                (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
            $pageIndex = 1;
            if ($request->has('pageIndex'))
                $pageIndex = $request->input('pageIndex');
            if ($pageIndex < 1) $pageIndex = 1;
            if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
            echo $keySearch;
            if($sx== 0)
            $products = Product::where('name', 'like', '%' . $keySearch . '%')->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->orderBy('product_details.price', 'asc')->skip(($pageIndex - 1) * $perPage)
                ->take($perPage)->select('products.*')->get();
            else
            $products = Product::where('name', 'like', '%' . $keySearch . '%')->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->orderBy('product_details.price', 'desc')->skip(($pageIndex - 1) * $perPage)
                ->take($perPage)->select('products.*')->get();
        } else {
            $numberOfRecord = Product::count();
            $perPage = 6;
            $numberOfPage = $numberOfRecord % $perPage == 0 ?
                (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
            $pageIndex = 1;
            if ($request->has('pageIndex'))
                $pageIndex = $request->input('pageIndex');
            if ($pageIndex < 1) $pageIndex = 1;
            if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
            if ($sx == 0)
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->orderBy('product_details.price', 'asc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
                else
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->orderBy('product_details.price', 'desc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)->select('products.*')
                        ->get();
        }
        $output = '';
        $output .= '
    <div id="showProduct" class="row">';
        foreach ($products as $item) {
            $output .= '<div class="col-md-4 col-xs-6">
        <div class="product">
            <div class="product-img">
                <img src="products_img/' . $item->productImage->first()->path . '" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">' . $item->productCategory->name . '</p>
                <h3 class="product-name"><a href="' . route("products.show", $item->id) . '">' . Str::limit($item->name, 40) . '</a></h3>';


            $price = $item->productDetail->min('price');
            $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
            $PriceX = number_format($price * 1.3, 0, ',', '.');
            $output .= '<h4 class="product-price">' . $formattedPrice . ' VND<del class="product-old-price">' . $PriceX . '</del></h4> <!-- Thêm đơn vị tiền tệ -->

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
                $output .= '<i class="fa fa-star"></i>';
            }
            $output .= '</div>

        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem chi tiết</span></button>
        </div>
    </div>
    <div class="add-to-cart">
    <form action="'. route('carts.store') .'" method="POST" class="add-to-cart-form">
    '. csrf_field() .'
        <input type="hidden" name="product_id" value="'. $item->id .'">
        <input type="hidden" name="price" value="'. $formattedPrice .'">
        <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
        
        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
    </form>
    </div>
</div>
</div>';
        }

        $output .= '</div>
        <div class="store-filter clearfix">
        <span class="store-qty">Sản phẩm</span>
        <ul class="store-pagination">';
        for ($i = 1; $i <= $numberOfPage; $i++) {
            if ($i == $pageIndex)
                $output .= '<li href="' . route('products.index', ['pageIndex' => $i]) . '" class="pa active">' . $i . '</li>';
            else
                // $output .= '<li><a href="'. route('products.index',['pageIndex' => $i]) .'" class="pa">'. $i .'</a></li>';
                $output .= '<li onclick="handlePageClick(' . $i . ')" class="pa">' . $i . '</li>';
        }
        $output .= '
        </ul>
    </div>';

        echo $output;
    }

    public function Start(Request $request)
    {
        $sx = $request->input('selectedValue');
        if ($request->has('searchTerm')) {
            $keySearch = $request->input('searchTerm');
            $numberOfRecord = Product::where('name', 'like', '%' . $keySearch . '%')->count();
            $perPage = 6;
            $numberOfPage = $numberOfRecord % $perPage == 0 ?
                (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
            $pageIndex = 1;
            if ($request->has('pageIndex'))
                $pageIndex = $request->input('pageIndex');
            if ($pageIndex < 1) $pageIndex = 1;
            if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
            // echo "Bạn đang tìm kiếm : ".$keySearch;
            if($sx== 0)
            $products = Product::where('name', 'like', '%' . $keySearch . '%')->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->orderBy('product_details.price', 'asc')->skip(($pageIndex - 1) * $perPage)
                ->take($perPage)->select('products.*')->get();
            else
            $products = Product::where('name', 'like', '%' . $keySearch . '%')->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->orderBy('product_details.price', 'desc')->skip(($pageIndex - 1) * $perPage)
                ->take($perPage)->select('products.*')->get();
        } else {
            $numberOfRecord = Product::count();
            $perPage = 6;
            $numberOfPage = $numberOfRecord % $perPage == 0 ?
                (int) $numberOfRecord / $perPage : (int) $numberOfRecord / $perPage + 1;
            $pageIndex = 1;
            if ($request->has('pageIndex'))
                $pageIndex = $request->input('pageIndex');
            if ($pageIndex < 1) $pageIndex = 1;
            if ($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
            if ($sx == 0)
            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->orderBy('product_details.price', 'asc')
            ->skip(($pageIndex - 1) * $perPage)
            ->take($perPage)
            ->select('products.*') // Chọn tất cả các trường từ bảng products
            ->get();

                else
                    $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->orderBy('product_details.price', 'desc')
                        ->skip(($pageIndex - 1) * $perPage)
                        ->take($perPage)
                        ->select('products.*')
                        ->get();
        }



        $output = '';
        $output .= '

    <div id="showProduct" class="row">';
        foreach ($products as $item) {
            $output .= '<div class="col-md-4 col-xs-6">
        <div class="product">
            <div class="product-img">
                <img src="products_img/' . $item->productImage->first()->path . '" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">' . $item->productCategory->name . '</p>
                <h3 class="product-name"><a href="' . route("products.show", $item->id) . '">' . Str::limit($item->name, 40) . '</a></h3>';

            $price = $item->productDetail->min('price');
            $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
            $PriceX = number_format($price * 1.3, 0, ',', '.');
            $output .= '<h4 class="product-price">' . $formattedPrice . ' VND<del class="product-old-price">' . $PriceX . '</del></h4> <!-- Thêm đơn vị tiền tệ -->
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
                $output .= '<i class="fa fa-star"></i>';
            }
            $output .= '</div>
        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem chi tiết</span></button>
        </div>
    </div>
    <div class="add-to-cart">
    <form action="'. route('carts.store') .'" method="POST" class="add-to-cart-form">
    '. csrf_field() .'
        <input type="hidden" name="product_id" value="'. $item->id .'">
        <input type="hidden" name="price" value="'. $formattedPrice .'">
        <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
        
        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
    </form>
</div>
</div>
</div>';
        }

        $output .= '</div>
        <div class="store-filter clearfix">
        <span class="store-qty">Sản phẩm</span>
        <ul class="store-pagination">';
        for ($i = 1; $i <= $numberOfPage; $i++) {
            if ($i == $pageIndex)
                $output .= '<li href="' . route('products.index', ['pageIndex' => $i]) . '" class="pa active">' . $i . '</li>';
            else
                // $output .= '<li><a href="'. route('products.index',['pageIndex' => $i]) .'" class="pa">'. $i .'</a></li>';
                $output .= '<li onclick="handlePageClick(' . $i . ')" class="pa">' . $i . '</li>';
        }
        $output .= '
        </ul>
    </div>';

        echo $output;
    }
}
