<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id(); // Mevcut kullanıcı
        $comment->post_id = $post->id;
        $comment->content = $validated['content'];
        $comment->save();

        return back()->with('success', 'Yorum başarıyla eklendi.');
    }

    public function destroy(Comment $comment)
    {
        // Sadece yorum sahibi veya admin silebilsin
        if (Auth::id() !== $comment->user_id) {
            return back()->with('error', 'Bu yorumu silme yetkiniz yok.');
        }

        $comment->delete();
        return back()->with('success', 'Yorum silindi.');
    }
}