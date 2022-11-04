<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getSignin()
    {
        return view('pages.signin');
    }

    public function getSignup()
    {
        return view('pages.signup');
    }
}
