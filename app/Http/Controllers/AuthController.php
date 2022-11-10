<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function getSignin()
    {
        return view('pages.signin');
    }

    public function postSignin(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required'
        ]);

        $credentials = $request->except('_token');

        if (auth()->attempt($credentials))
        {
            return redirect()->route('home');
        }

        session()->flash('message', 'Invalid email or password');
        return redirect()->back()->withInput();
    }

    public function getSignup()
    {
        return view('pages.signup');
    }

    public function postSignup(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        Session::flush();
        \Auth::logout();

        return redirect()->route('home');
    }
}
