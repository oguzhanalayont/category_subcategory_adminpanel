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
                      ->orderByDesc('created_at');
            }])
            ->take(3) // İlk 3 kategoriyi al
            ->orderByDesc('created_at')
            ->get();

        return view('home', compact('categories'));
    }
}