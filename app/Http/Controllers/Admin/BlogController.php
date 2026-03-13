<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller {
    public function index() {
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }
    public function create() { return view('admin.blogs.create'); }

    public function store(Request $request) {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'category'     => 'nullable|string',
            'tags'         => 'nullable|string',
            'read_time'    => 'nullable|integer',
            'is_published' => 'boolean',
            'is_featured'  => 'boolean',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        $data['slug'] = Str::slug($data['title']);
        if ($request->boolean('is_published')) $data['published_at'] = now();
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }
        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created!');
    }

    public function edit(Blog $blog) { return view('admin.blogs.edit', compact('blog')); }

    public function update(Request $request, Blog $blog) {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'category'     => 'nullable|string',
            'tags'         => 'nullable|string',
            'read_time'    => 'nullable|integer',
            'is_published' => 'boolean',
            'is_featured'  => 'boolean',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        if ($request->boolean('is_published') && !$blog->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }
        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated!');
    }

    public function destroy(Blog $blog) {
        if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted!');
    }
}