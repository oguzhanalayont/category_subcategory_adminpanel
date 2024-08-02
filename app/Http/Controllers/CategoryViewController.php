<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Forum;

use Illuminate\Http\Request;

class CategoryViewController extends Controller
{

    public function view(Category $category)
    {
        $category->load('forums');
        return view('categories.view', compact('category'));
    }
}
