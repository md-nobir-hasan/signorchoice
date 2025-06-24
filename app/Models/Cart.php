<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'size_id',
        'color_id',
        'ip',
        'price',
        'discount',
        'status',
        'quantity',
        'amount',
        'inventory_cost',
    ];

    // public function product(){
    //     return $this->hasOne('App\Models\Product','id','product_id');
    // }
    // public static function getAllProductFromCart(){
    //     return Cart::with('product')->where('user_id',auth()->user()->id)->get();
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
    public function totalAmount(){
        $final_price = $this->size->final_price;
        return $final_price * $this->quantity;
    }
}
