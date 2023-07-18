<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\FacebookApiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\WishlistController;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products', [ProductController::class, 'apiIndex']);
Route::get('/products/{product}', [ProductController::class, 'productPageToApi']);
Route::get('/blog', [BlogController::class, 'apiToView']);


Route::post('/register', [RegisterController::class, 'registerIndex']);
Route::post('/login', [LoginController::class, 'LoginIndex']);

Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::post('/cart/addGuest', [CartController::class, 'addToCart']);
Route::post('/cart/checkout', [OrderController::class, 'checkout'])->middleware('auth:sanctum');
Route::get('/order', [OrderController::class, 'orderIndex'])->middleware('auth:sanctum');


// Route::post('/cart/add-to-cart/', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'cartToApi'])->middleware('auth:sanctum');
Route::PATCH('/cart/item', [CartController::class, 'updateCartItem'])->middleware('auth:sanctum');
Route::delete('/cart/item', [CartController::class, 'deleteCartItem'])->middleware('auth:sanctum');



Route::get('/us/profile', [UserController::class, 'getProfile']) ->middleware('auth:sanctum');
Route::post('/user/profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlists', [WishlistController::class, 'wishlistToApi']);
    Route::post('/wishlists', [WishlistController::class, 'addToWishlist']);
    Route::delete('/wishlists/{wishlist}', [WishlistController::class, 'deleteFromWishlist']);
});





    Route::get('test', function () {
        return response()->json([
            'message' => 'You are authenticated'
        ]);
    })->middleware('auth:sanctum');



