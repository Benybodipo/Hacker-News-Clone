<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Jobs\NewsJob;
use App\Models\ChildItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function index()
    {
        $items = Item::where('type', 2)->with('comments')->paginate(10);
        // $this->dispatch(new NewsJob());
        
        return view('pages.home')->with('items', $items);
    }

    public function comments($id)
    {
        $item = Item::where('original_id', $id)->with('comments');
        
        
        return view('pages.item')->with('item', (object)$item->first());
    }

    public function showUser($id)
    {        
        $response = Http::get("https://hacker-news.firebaseio.com/v0/user/{$id}.json?print=pretty");
        $user = $response->object();
       
        return view('pages.user')->with('user', $user);
    }

}
