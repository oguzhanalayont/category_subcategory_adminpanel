<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::withCount('forums')
            ->with(['forums' => function ($query) {
                $query->withCount('posts')
                      ->take(3)
                      ->orderBy('created_at');
            }])
            ->take(3)
            ->orderBy('created_at')
            ->get();

        return view('home', compact('categories'));
    }
}