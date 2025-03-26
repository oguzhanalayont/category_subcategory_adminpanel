<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('category')->withCount('posts')->get();
        return view('admin.forums.index', compact('forums'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.forums.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        Forum::create($validatedData);

        return redirect()->route('admin.forums.index')->with('success', 'Forum created successfully.');
    }

    public function edit(Forum $forum)
    {
        $categories = Category::all();
        return view('admin.forums.edit', compact('forum', 'categories'));
    }

    public function update(Request $request, Forum $forum)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $forum->update($validatedData);

        return redirect()->route('admin.forums.index')->with('success', 'Forum updated successfully.');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums.index')->with('success', 'Forum deleted successfully.');
    }
}