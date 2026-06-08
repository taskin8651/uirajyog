<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255|unique:blogs,title',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        Blog::create([
            'title'             => $request->title,
            'slug'              => $this->makeUniqueSlug($request->title),
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'             => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $blog->update([
            'title'             => $request->title,
            'slug'              => $this->makeUniqueSlug($request->title, $blog->id),
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            Blog::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
