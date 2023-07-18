<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $cartItem = new CartItem;
        $cartItem->cart_id = $request->input('cart_id');
        $cartItem->product_id = $request->input('product_id');
        $cartItem->quantity = $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->back();
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $cartItem->quantity = $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->back();
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->back();
    }
}
