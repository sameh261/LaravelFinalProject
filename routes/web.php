<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//routes for unauthenticated users
Auth::routes();
Auth::routes(['verify' => true]);

//routes for authenticated users
Route::group(['middleware' => ['CheckAuth']], function () {

    // categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth', 'role:1');

    // products routes
    Route::get('/products', [ProductController::class, 'index'])->middleware('verified')->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth', 'role:1');

    // blogs routes
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blogCreate');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy')->middleware('auth', 'role:1');

    // dashboard routes
    Route::get('/', function () {
        $products = Product::count();
        $categories = Category::pluck('name');
        $blogs = Blog::pluck('title');
        $orders = Order::count();
        $customers = User::count();
        return view('dashboard', compact('products', 'categories', 'blogs', 'orders', 'customers'));
    });

    //admin routes
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index')->middleware('auth', 'role:1');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update')->middleware('auth', 'role:1');
});


//routes for verified users
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


//Facebook login routes
// Redirect the user to Facebook for authentication
Route::get('/auth/redirect',[FacebookController::class, 'redirectToFacebook'])->name('login.facebook');

// Handle the callback from Facebook
Route::get('/auth/callback',[FacebookController::class, 'handleFacebookCallback']);
