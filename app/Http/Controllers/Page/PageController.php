<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
