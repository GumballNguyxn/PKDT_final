<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'product_category_id', 'brand_id', 'description', 'details', 'quantity', 'product_images'];



    # 
    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    #
    public function productDetail(){
        return $this->hasMany(ProductDetail::class,'product_id','id');
    }
    #
    public function productComment(){
        return $this->hasMany(ProductComment::class,'product_id','id');
    }
    #
    public function productBrand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    #
    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }
    #
    public function productFavorites()
    {
        return $this->hasMany(ProductFavorite::class, 'product_id', 'id');
    }
    #
    public function getTotalProductCategory(){
        return Product::where('product_category_id',$this->product_category_id)->count();
    }
    #
    public function getTotalProductBrand(){
        return Product::where('brand_id',$this->brand_id)->count();
    }
    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderDetail::class, 'product_id', 'id', 'id', 'order_id');
    }
}
