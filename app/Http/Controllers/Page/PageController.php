<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
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

    public function privatePolicy()
    {
        return inertia('PrivacyPolicy');
    }

    public function terms()
    {
        return inertia('Terms');
    }

    public function contact()
    {
        return inertia('Contact');
    }

    public function partners()
    {
        return inertia('Partners');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Mail::to('contact@hextechplay.com')->send(new ContactMail($request->all()));

        return redirect()->back()->with('success', __('site.message_sent'));
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
