<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(Category $category)
    {
        return view('categories.index')->with([
            'posts' => $category->posts()->with('category')->orderBy('created_at', 'DESC')->get(),
            'category' => $category
        ]);
    }
}
