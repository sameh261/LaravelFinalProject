<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('public/images/categories');
        }
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');

        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::delete($category->image);

            // Store the new image
            $category->image = $request->file('image')->store('public/images/categories');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
