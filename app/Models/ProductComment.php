<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function commentProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
