<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();

        return view('carts.index', compact('carts'));
    }
    public function show(Cart $cart)
    {
        return view('carts.show', compact('cart'));
    }
    public function store(Request $request)
    {
        $cart = new Cart;
        $cart->user_id = auth()->user()->id ?? null;
        $cart->session_id = $request->session_id;
        $cart->save();
        return redirect()->route('carts.show', $cart);
    }
    public function update(Request $request, Cart $cart)
    {
        $cart->fill($request->only(['user_id', 'session_id']));
        $cart->save();
        return redirect()->route('carts.show', $cart);
    }
    public function addToCart(Request $request)
{
    $user = auth()->user();
    $cart = Cart::where('user_id', $user->id)->first();
    if (!$cart) {
        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->save();
    }
    $product = Product::findOrFail($request->product_id);

    if ($request->quantity <= 0 || $request->quantity > $product->quantity) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid product quantity.',
        ]);
    }

    $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

    $quantityToAdd = min(5 - ($cartItem ? $cartItem->quantity : 0), $request->quantity);
    if ($quantityToAdd <= 0) {
        return response()->json([
            'success' => false,
            'message' => 'You can not add more than 5 products of the same type.',

        ]);
    }

    if ($cartItem) {
        $cartItem->quantity += $quantityToAdd;
        $cartItem->total_price = $cartItem->quantity * $product->price;
        $cartItem->save();
    } else {
        $cartItem = new CartItem;
        $cartItem->cart_id = $cart->id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity = $quantityToAdd;
        $cartItem->price = $product->price;
        $cartItem->total_price = $product->price * $quantityToAdd;
        $cartItem->save();
    }
    return response()->json([
        'success' => true,
        'message' => 'Product added to cart.',
        'cart' => $cartItem->cart,
    ]);
}


    public function cartToApi()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->items()->get();
        return CartItemResource::collection($cartItems);
    }

    public function updateCartItem(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $quantity = $request->input('quantity', 1);

        if ($quantity < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity cannot be negative.',
            ], 400);
        }
        if ($quantity > 5) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity cannot be greater than 5.',
            ], 400);
        }

        $cartItem = CartItem::find($cartItemId);
        $cartItem->quantity = $quantity;
        $cartItem->updateQuantity($quantity);
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated.',
            'cart' => $cartItem->cart,
        ]);
    }


    public function deleteCartItem(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $cartItem = CartItem::find($cartItemId);
        $cartItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Cart item deleted.',
            'cart' => $cartItem->cart,
        ]);
    }
}
