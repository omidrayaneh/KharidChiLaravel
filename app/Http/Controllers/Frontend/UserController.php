<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user=new User();
        $user->name=$request->input('name');
        $user->last_name=$request->input('last_name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->mobile=$request->input('mobile');
        $user->password=Hash::make($request->input('password'));

        $user->save();
        Session::flash('success', 'کاربر با موفقیت ثبت شد.');
        return redirect('/login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile.index', compact(['user']));
    }
}
