<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity' , 'price', 'total_price'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    function updateQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->total_price = $this->product->price * $quantity;
        $this->save();
    }

    function updatePrice($price)
    {
        $this->price = $price;
        $this->total_price = $this->product->price * $this->quantity;
        $this->save();
    }
}
