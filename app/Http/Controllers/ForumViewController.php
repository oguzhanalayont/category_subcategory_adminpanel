<?php

namespace App\Http\Controllers;
use App\Models\Forum;
use App\Models\Category;

use Illuminate\Http\Request;

class ForumViewController extends Controller
{
    public function view(Forum $forum)
{
    $forum->load('posts');
    return view('forums.view', compact('forum'));
}
public function index()
    {
        $forums = Forum::with('category')->withCount('posts')->get();
        return view('forums.index', compact('forums'));
    }
}
