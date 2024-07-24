<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['forums' => function($query) {
            $query->withCount('posts');
        }, 'forums.posts' => function($query) {
            $query->latest()->limit(3);
        }])
        ->withCount('forums')
        ->get();

        return view('home', compact('categories'));
    }
}