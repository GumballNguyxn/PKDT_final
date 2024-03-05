<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['user_id','name', 'email', 'phone_number', 'address', 'total_price'];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
