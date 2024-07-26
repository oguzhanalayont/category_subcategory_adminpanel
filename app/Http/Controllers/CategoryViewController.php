<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryViewController extends Controller
{
    public function view($id)
{
    $category = Category::with('forums')->findOrFail($id);
    return view('categories.view', compact('category'));
}
}
