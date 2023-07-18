<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id'];

    protected $with = ['items.product'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function totalPrice()
    {
        return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
