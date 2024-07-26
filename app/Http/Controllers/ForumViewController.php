<?php

namespace App\Http\Controllers;
use App\Models\Forum;
use App\Models\Category;

use Illuminate\Http\Request;

class ForumViewController extends Controller
{
    public function view($id)
{
    $forum = Forum::with('posts')->findOrFail($id);
    return view('forums.view', compact('forum'));
}
}
