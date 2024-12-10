<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Forum;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::with(['forum', 'comments.user'])
        ->withCount('comments')
        ->latest()
        ->paginate(10);
    
    return view('posts.index', compact('posts'));
}
    public function create()
    {
        $forums = Forum::all();
        return view('posts.create', compact('forums'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'forum_id' => 'required|exists:forums,id',
        ]);

        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $forums = Forum::all();
        return view('posts.edit', compact('post', 'forums'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'forum_id' => 'required|exists:forums,id',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}