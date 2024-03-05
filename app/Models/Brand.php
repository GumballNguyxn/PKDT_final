<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product ;
class Brand extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name'];
    public function brandProduct(){
        return $this->hasMany(Product::class,'brand_id','id');
    }
    public function getTotalBrand(){
        return Product::where('brand_id',$this->id)->count();
    }
}
