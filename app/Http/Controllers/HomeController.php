<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $sites = Site::where('is_active', 1)
            ->orderBy('name')
            ->take(12)
            ->get();
        return view('layouts.home', compact('sites'));
    }

    public function goto($id)
    {
        $site = Site::where('id', $id)->first();
        if ($site) {
            return redirect()->away($site->url);
        } else {
            return redirect()->route('homepage');
        }
    }
}
