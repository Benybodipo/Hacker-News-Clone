<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function comments()
    {
        return view('pages.comments');
    }
}