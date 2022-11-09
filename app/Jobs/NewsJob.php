<?php

namespace App\Jobs;

use App\Models\Item;
use App\Models\ChildItem;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $types = [
        1 => 'job',
        2 => 'story',
        3 => 'comment',
        4 => 'poll',
        5 => 'pollopt',
    ];
    private $stories = 'topstories';
    private $from = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($stories)
    {
        $this->stories = $stories;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get("https://hacker-news.firebaseio.com/v0/{$this->stories}.json?print=pretty");
        $ids = $response->object();
        $items = array();

        $counter =  0;
        for ($i=0; $i < count($ids) ; $i++) { 
            $id = $ids[$i];
            $this->from = $id;

            if (!Item::where('original_id', $id)->count()) {
                $res  = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                $item = $res->json();
                if (!Item::where('original_id', $item['id'])->count()) {
                    $item['category'] = $this->stories;
                    
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


    private function getKids($item_id, $kids) {
        $counter = 0;
        for ($i=0; $i < count($kids) ; $i++) { 
            $id = $kids[$i];

            if (!Item::where('original_id', $id)->count()) {
                $response  = Http::get("https://hacker-news.firebaseio.com/v0/item/{$id}.json?print=pretty");
                $item = $response->json();
                $item['from'] = $this->from;
                Item::create($this->formatItem($item)); # Insert new item
                if (isset($item['kids'])) {
                    $this->getKids($item_id, $item['kids']);
                }
            }
        }
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
