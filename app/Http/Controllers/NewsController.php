<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        $items = Item::where('type', 2)->get();

        if (!$items->count()) {
            $response = Http::get('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
            $ids = $response->object();
            $items = array();
    
            $counter =  0;
            for ($i=0; $i < count($ids) ; $i++) { 
                $id = $ids[$i];

                if (!Item::where('original_id', $id)->count()) {
                    $res  = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                    $item = $res->json();
                    if (!Item::where('original_id', $item['id'])->count()) {
                        Item::insert($this->formatItem($item));
                        if (isset(($res->json())['kids'])) {
                            $this->getKids($id, $item['kids']);
                        }
                    }
                    
                    $counter++;
                }
                if ($counter+1 == 10) {
                    break;
                }
            }
        }
        
        return view('pages.home')->with('items', $items);
    }

    public function comments($id)
    {

        $item = Item::where('original_id', $id);
        
        if (!$item->count()) {
            $response = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
            $response = $response->json();
            
            if (isset($response['kids'])) {
                for ($i=0; $i < count($response['kids']) ; $i++) { 
                    $id = $response['kids'][$i];
                    $comment = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                    $response['comments'][] = $comment->object();
                }
            }
        }

        // dd();
        return view('pages.item')->with('item', (object)$item->first()->toArray());
    }

    private function getKids($item_id, $kids) {

        for ($i=0; $i < count($kids) ; $i++) { 
            $id = $kids[$i];

            if (!Item::where('original_id', $id)->count()) {
                $response  = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                $item = $response->json();

                Item::create($this->formatItem($item)); # Insert new item
                if (isset($item['kids'])) {
                    $this->child_item[] = [
                        'parent' => $item_id,
                        'child' => $item['id']
                    ];
                    $this->getKids($item['id'], $item['kids']);
                }
            }
        }
        ChildItem::insert($this->child_item);
        $this->child_item = [];

    }

    private function formatItem($item): Array
    {
        $item['original_id'] = $item['id'];
        $item['type'] = array_search($item['type'], $this->types);
        if (isset($item['kids']) ) {
            $item['kids'] = json_encode($item['kids']);
        }
        if (isset($item['parts']) ) {
            $item['parts'] = json_encode($item['parts']);
        }
        unset($item['id']);

        return $item;
    }
}
