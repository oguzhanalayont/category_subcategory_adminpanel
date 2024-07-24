<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $categories = Category::with(['forums' => function($query) {
        $query->withCount('posts')->with(['posts' => function($query) {
            $query->latest()->take(3);
        }]);
    }])
    ->withCount('forums')
    ->get();

    return view('home', compact('categories'));
}
}