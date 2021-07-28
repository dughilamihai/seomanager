<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first(); 
        $sites = Site::where('category_id', $category->id)
               ->orderBy('name')
               ->take(12)
               ->get();   


         return view('layouts.category', compact('sites'));
    }
}