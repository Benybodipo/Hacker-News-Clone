<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $response = Http::get('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
        $ids = $response->object();
        $items = array();

        for ($i=0; $i < count($ids) ; $i++) { 
            $id = $ids[$i];
            $res  = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");

            $item = $res->object();
            $items[] = $item;
            
            if ($i+1 == 10) {break;}
        }

        // dd($items);
        return view('pages.home')->with('items', $items);
    }

    public function comments($id)
    {
        $response = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
        $response = $response->json();
        
        if (isset($response['kids'])) {
            for ($i=0; $i < count($response['kids']) ; $i++) { 
                $id = $response['kids'][$i];
                $comment = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                $response['comments'][] = $comment->object();
            }
        }

        return view('pages.item')->with('item', (object)$response);
    }
}
