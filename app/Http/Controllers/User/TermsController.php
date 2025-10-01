<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function accept(Request $request)
    {
        $user = User::find(Auth::id());
        $user->accepted_terms_version = config('app.terms_version', '1.0');
        $user->accepted_at = now();
        $user->save();

        return redirect()->route('home')->with('success', 'Termos aceitos com sucesso!');
    }
}
