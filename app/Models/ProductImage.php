<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'product_id',
        'path',
    ];
    

    public function imageProduct(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
