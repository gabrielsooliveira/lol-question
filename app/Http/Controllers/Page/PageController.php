<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $translations = trans('home');
        return inertia('Home', [
            'translations' => $translations
        ]);
    }

    public function menu()
    {
        $translations = trans('menu');
        return inertia('Menu', [
            'translations' => $translations
        ]);
    }

    public function loreQuestion()
    {
        $translations = trans('loreQuestion');
        return inertia('LoreQuestion/Index', [
            'translations' => $translations
        ]);
    }

    public function privatePolicy()
    {
        $translations = trans('privacyPolicy');
        return inertia('PrivacyPolicy', [
            'translations' => $translations
        ]);
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
