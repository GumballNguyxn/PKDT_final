<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFavoriteDetail extends Model
{
    use HasFactory;
    protected $table = 'favorite_details';
    public function productFavorite()
    {
        return $this->belongsTo(ProductFavorite::class, 'favorite_id');
    }
    
}
