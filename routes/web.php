<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxController ;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProductFavoriteController;



Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Router brand
Route::get('admin/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('admin/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('admin/brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('admin/brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
Route::put('admin/brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('admin/brand/destroy/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

// category
Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::get('admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::post('admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
Route::put('admin/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

// Route product
Route::resource('products', ProductController::class);
Route::get('/admin/products/{productId}/{productDetailId}/edit', [ProductController::class, 'editProduct'])->name('admin.products.edit');
Route::put('/products/{productId}/{productDetailId}', [ProductController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/products/{productId}/{productDetailId}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
Route::put('/admin/products/{productId}/updateImage/{productImageId}', [ProductController::class, 'updateImage'])->name('admin.products.updateImage');
Route::get('/admin/products', [ProductController::class, 'showInAdmin'])->name('admin.products.index');
Route::get('/admin/products/{productId}/{productDetailId}', [ProductController::class, 'showProductDetail'])->name('admin.products.showDetail');

//Router danh sách yêu thích
Route::resource('favorites', ProductFavoriteController::class);



// routes/web.php

Route::get('productAjaxStart', [AjaxController::class, 'Start']);
Route::get('productAjaxPhanTrang', [AjaxController::class, 'phanTrang']);
Route::get('homeAjaxProductMoi', [HomeController::class, 'ajaxHomeProductMoi']);
Route::get('homeAjaxProductBanChay', [HomeController::class, 'ajaxHomeProductBanChay']);


Route::post('products/{id}/comments', [ProductCommentController::class, 'store'])->name('product.comments.store');

// Route::get('productAjax', [AjaxController::class, 'getProducts']);
Route::get('productAjax', [AjaxController::class, 'getProducts']);

Route::middleware('auth')->group(function () {
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::resource('users',UserController::class);
// Router giỏ hàng
Route::resource('carts', CartController::class);

//profile
Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
Route::put('/profile/{user}', [UserController::class, 'update'])->name('update-profile');

});

Route::resource('checkouts', CheckoutController::class);
Route::post('/place-order', [CheckoutController::class, 'placeorder'])->name('place-order');
Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');


Route::get('/admin/order/', [AdminOrderController::class, 'index'])->name('admin.order.index');
Route::get('/admin/order/show/{order}', [AdminOrderController::class, 'show'])->name('admin.order.show');
