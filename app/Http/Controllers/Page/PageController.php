<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return inertia('Home');
    }

    public function menu()
    {
        return inertia('Menu');
    }

    public function loreQuestion()
    {
        return inertia('LoreQuestion/Index');
    }

    public function privatePolicy()
    {
        return inertia('PrivacyPolicy');
    }

    public function terms()
    {

        return inertia('Terms');
    }

    public function translate($locale)
    {
        $available = ['en', 'pt'];
        if (in_array($locale, $available)) {
            session(['locale' => $locale]);
        }
        return back();
    }
}
