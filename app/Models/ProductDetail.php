<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['product_id', 'color', 'quantity', 'price'];
    public function detailProduct(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class, 'product_id');
    }
}
