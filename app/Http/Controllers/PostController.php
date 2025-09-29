<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(function ($p) {
                return [
                    'id'         => $p->id,
                    'title'      => $p->title,
                    'category'   => [
                        'id'   => $p->category?->id,
                        'name' => $p->category?->name,
                    ],
                    'created_at' => $p->created_at->toIso8601String(),
                ];
            });

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'flash' => [
                'success' => session('success'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create', [
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('category');

        return Inertia::render('Posts/Edit', [
            'post' => [
                'id'          => $post->id,
                'title'       => $post->title,
                'body'        => $post->body,
                'category_id' => $post->category_id,
            ],
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
