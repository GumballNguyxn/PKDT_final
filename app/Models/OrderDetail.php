<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

}
