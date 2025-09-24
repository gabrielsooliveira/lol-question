<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $translations = trans('lorequestion');
        return inertia('LoreQuestion/Index', [
            'translations' => $translations
        ]);
    }
}
