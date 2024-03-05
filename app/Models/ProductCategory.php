<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name'];
    public function categoryProduct(){
        return $this->hasMany(Product::class,'product_category_id','id');
    }
    public function getTotalCategory(){
        return Product::where('product_category_id',$this->id)->count() ;
    }
}
