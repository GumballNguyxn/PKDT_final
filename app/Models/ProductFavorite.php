<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductFavoriteDetail;

class ProductFavorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $fillable = [
        'user_id',
    ];
    public function items()
    {
        return $this->hasMany(ProductFavoriteDetail::class, 'favorite_id');
    }
    

}
