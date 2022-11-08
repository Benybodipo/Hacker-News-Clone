<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;
    protected $appends = [
        'children',
    ];

    protected $fillable =  [
        'title',
        'original_id',
        'url',
        'by',
        'text',
        'type',
        'kids',
        'score',
        'parts',
        'descendants',
        'dead',
        'deleted',
        'time',
    ];

    public function itemType()
    {
        return $this->hasOne(Type::class, 'type');
    }

    // public function children(): BelongsToMany
    // {
    //     return $this->belongsToMany(Item::class, 'child_items', 'child', 'parent');
    // }

    public function getChildrenAttribute()
    {
        if (!is_null($this->kids)) {
            $arr = json_decode($this->kids);
            return Item::whereIn('original_id', $arr)->get();
        }
    }
}
