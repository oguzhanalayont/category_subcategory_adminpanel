<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['forums' => function($query) {
            $query->withCount('posts')->limit(3);
        }, 'forums.posts' => function($query) {
            $query->limit(3);
        }])->get();

        return view('home', compact('categories'));
    }
}