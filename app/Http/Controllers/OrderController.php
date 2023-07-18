<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    /**
     * Place a new order.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart is empty'
            ], 404);
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->cart_id = $cart->id;
        $order->status = 'pending';
        $order->payment_method = 'pay_on_delivery';
        $order->total_price = $cart->items()->sum('total_price');
        $order->checkout_id = Str::random(8);
        $order->save();
        $order->reduceProductQuantities();

        foreach ($cart->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();

        }

        $cart->items()->delete();

        return response()->json([
            'message' => 'Order placed successfully!',
            'order' => $order
        ]);
    }

    /**
     * Get the user's orders.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        $orders = Order::where('user_id', $user->id)->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    /**
     * Get a specific order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderIndex()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        $orders = Order::where('user_id', $user->id)->get();

        return OrderResource::collection($orders);
    }
}
