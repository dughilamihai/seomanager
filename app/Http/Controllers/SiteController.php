<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Comment;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function show($slug)
    {
        $site = Site::where('slug', $slug)->first();
        $comments = $site->comments;

         return view('layouts.site', compact('site','comments'));
    }
}
