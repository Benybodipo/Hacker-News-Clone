<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Jobs\NewsJob;
use App\Models\ChildItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class NewsController extends Controller
{
    private $types = [
        1 => 'job',
        2 => 'story',
        3 => 'comment',
        4 => 'poll',
        5 => 'pollopt',
    ];
    public $comments = [];
    public $child_item = [];

    public function index($page=null)
    {
        $allowed_pages = ['home', 'beststories'];
        $page_name = Route::currentRouteName();
        $items = null;

       
        if ($page_name == 'home'){
            $items = Item::where('type', 2)->with('comments');
        }
        else if ($page_name == 'newstories'){
            $items = Item::where('type', 2)->where('category', 'newstories')->orderBy('time', 'desc')->with('comments');
        }

        
        $items = $items->paginate(10);
        
        return view('pages.home')->with('items', $items);
    }

    public function show($id)
    {
        $item = Item::where('original_id', $id)->with('comments')->first()->toJson();     
        return view('pages.item')->with('item', (object)json_decode($item));
    }

    public function comments()
    {
        dd(Route::currentRouteName());
        $comments = Item::where('type', 3)->orderBy('time', 'desc')->paginate(10); 
        
        return view('pages.comments')->with('comments', $comments);
    }

    public function comment($id)
    {
        $comment = Item::where('original_id', $id)->first(); 
        
        return view('pages.comment')->with('comment', (object)$comment);
    }

    public function showUser($id)
    {        
        $response = Http::get("https://hacker-news.firebaseio.com/v0/user/{$id}.json?print=pretty");
        $user = $response->object();
       
        return view('pages.user')->with('user', $user);
    }

}
