<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function show($slug)
    {
        $site = Site::where('slug', $slug)->first(); 


         return view('layouts.site', compact('site'));
    }
}