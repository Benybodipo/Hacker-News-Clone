<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Jobs\NewsJob;
use App\Models\ChildItem;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
        $comments = Item::where('type', 3)->orderBy('time', 'desc')->paginate(10);

        return view('pages.comments')->with('comments', $comments);
    }

    public function comment($id)
    {
        $comment = Item::where('original_id', $id)->first()->toJson();

        return view('pages.comment')->with('comment', (object)json_decode($comment));
    }

    public function commentOn(Request $request, int $type)
    {
        
        $request->validate([
            'text' => 'required|min:3',
            'parent' => 'required|exists:items,original_id',
            'from' => 'required|exists:items,original_id',
            'by' => 'required|exists:users,username',
        ]);
        
        
        $request['time'] = strtotime(Carbon::now());
        $request['type'] = 3;
        
        $item = Item::create($request->all());
        Item::whereId($item->id)->update([ 'original_id' => $item->id ]);

        ## Update parents
        $parent = Item::where('original_id', $request->parent)->first();
        if ($parent->kids) {
            $array_kids = json_decode($parent->kids);
            array_unshift($array_kids , $item->id);
        }
        else {
            $array_kids[] = $item->id;
        }

        $parent_data = ['kids' => $array_kids];

        if ($type == 2) {
            $parent_data['descendants'] = (int)$parent->descendants + 1;
        }
        $parent->update($parent_data);
        
        return redirect()->back();


    }

    public function showUser($id)
    {
        $user = User::where('username', $id)->first();

        if ($user) {
            $user = (object)([
                'created' => strtotime($user->created_at),
                'submitted' => UserHistory::where('by', $id)->where('submissions', 1)->get(),
                'karma' => 0
            ]);
        }
        else {
            $response = Http::get("https://hacker-news.firebaseio.com/v0/user/{$id}.json?print=pretty");
            $user = $response->object();
        }
        return view('pages.user')->with('user', $user);
    }

    public function action($item_id, $type)
    {
        
        $history = UserHistory::where('by', auth()->user()->username)
                                ->where('item_id', $item_id)
                                ->first();
        $action = ($type == 1) ? 'vafourites' : 'hide';
      

        if ($history) {
            $data[$action] = !($history->toArray())[$action];
            $history->update($data);
        }
        else {
            $data = [
                'by' => auth()->user()->username,
                'item_id' => $item_id
            ];
            $action = ($type == 1) ? 'vafourites' : 'hide';
            $data[$action] = true;

            UserHistory::create($data);
        }
        return redirect()->back();
    }

    
    public function submit(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('pages.submit');

        }
        else{
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:3',
                'url' => 'required|url',
                'text' => 'required|min:3'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $request['by'] = auth()->user()->username;
            $request['type'] = 2;
            $request['category'] = 'newstories';
            $request['score'] = 0;
            $request['time'] = strtotime(Carbon::now());
            $request['time'] = strtotime(Carbon::now());


            $item = Item::create($request->all());
            Item::whereId($item->id)->update([ 'original_id' => $item->id ]);

            UserHistory::create([
                'by' => auth()->user()->username,
                'item_id' => $item->id,
                'submissions' => true,
            ]);

            return redirect()->route('home');
        }

    }

}
