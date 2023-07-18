<?php


namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blog', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('blogCreate');
    }

    public function store(Request $request)
    {
        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->user_id = auth()->user()->id;
        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('public/images/blogs');
        }
        $blog->save();
        return redirect('/blog')->with('success', 'Blog created successfully!');

    }



    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blogShow', ['blog' => $blog]);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blogEdit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        if ($request->hasFile('image')) {
            Storage::delete($blog->image);
            $blog->image = $request->file('image')->store('public/images/blogs');
        }
        $blog->save();
        return redirect('/blog');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/blog');
    }

    public function apiToView(Request $request)
    {
        $search = $request->input('search', '');
        $blogsQuery = Blog::query();

        $blogsQuery->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('content', 'LIKE', '%' . $search . '%');
        });

        $blogs = $blogsQuery->paginate(10);

        return response()->json($blogs);
    }

}
