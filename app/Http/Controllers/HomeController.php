<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::with('features')->where('is_active', true)->orderBy('sort_order')->get();
        $headerPages = Page::placed('header')->get();
        $footerPages = Page::placed('footer')->get();
        return view('home', compact('plans', 'headerPages', 'footerPages'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->published()->firstOrFail();
        $headerPages = Page::placed('header')->get();
        $footerPages = Page::placed('footer')->get();
        return view('page', compact('page', 'headerPages', 'footerPages'));
    }
}
