<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->first();
        if (!$wishlist) {
            $wishlist = new Wishlist;
            $wishlist->user_id = $user->id;
            $wishlist->save();
        }
        $wishlist->products()->attach($request->product_id);
        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist'
        ]);
    }
    public function wishlistToApi()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->first();
        if (!$wishlist) {
            $wishlist = new Wishlist;
            $wishlist->user_id = $user->id;
            $wishlist->save();
        }
        return response()->json([
            'success' => true,
            'data' => $wishlist->products
        ]);
    }
    public function deleteFromWishlist(Request $request)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->first();
        if (!$wishlist) {
            $wishlist = new Wishlist;
            $wishlist->user_id = $user->id;
            $wishlist->save();
        }
        $wishlist->products()->detach($request->product_id);
        return response()->json([
            'success' => true,
            'message' => 'Product removed from wishlist'
        ]);
    }



}
