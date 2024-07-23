<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Category;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('category')->withCount('posts')->get();
        return view('forums.index', compact('forums'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('forums.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        Forum::create($validatedData);

        return redirect()->route('forums.index')->with('success', 'Forum created successfully.');
    }

    public function show(Forum $forum)
    {
        $forum->load('posts', 'category');
        return view('forums.show', compact('forum'));
    }

    public function edit(Forum $forum)
    {
        $categories = Category::all();
        return view('forums.edit', compact('forum', 'categories'));
    }

    public function update(Request $request, Forum $forum)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $forum->update($validatedData);

        return redirect()->route('forums.index')->with('success', 'Forum updated successfully.');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('forums.index')->with('success', 'Forum deleted successfully.');
    }
}