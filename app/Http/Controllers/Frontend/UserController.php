<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return $request->all();
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile.index', compact(['user']));
    }
}
