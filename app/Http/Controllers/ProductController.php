<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $category_id = $request->input('category_id');

        $productsQuery = Product::query();

        if ($category_id) {
            $productsQuery->where('category_id', $category_id);
        }

        $productsQuery->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
        });

        $products = $productsQuery->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('products', 'search', 'category_id', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = new Product($validatedData);
        $product->slug = Str::slug($validatedData['name']);
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public/images/products');
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $product->fill($validatedData);
        $product->slug = Str::slug($validatedData['name']);
        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $product->image = $request->file('image')->store('public/images/products');
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function apiIndex(Request $request)
    {
        $products = Product::query();

        if ($request->has('category_id')) {
            $products->where('category_id', $request->input('category_id'));
        }

        if ($request->has('search')) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        });
        }

        if ($request->has('limit')) {
            $products->limit($request->input('limit'));
        }

        $products->where('quantity', '>', 0);

        $products = $products->get();

        return ProductResource::collection($products);
    }

    public function productPageToApi(Product $product)
    {
        return new ProductResource($product);
    }
}
