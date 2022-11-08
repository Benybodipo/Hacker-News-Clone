<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HasMany;
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
        'parent',
        'descendants',
        'dead',
        'deleted',
        'time',
    ];

    public function itemType()
    {
        return $this->hasOne(Type::class, 'type');
    }

    public function comments()
    {
        return $this->hasMany(Item::class, 'parent', 'original_id');
    }
    
    

    public function getChildrenAttribute()
    {
        if (!is_null($this->kids)) {
            $arr = json_decode($this->kids);
            return Item::whereIn('original_id', $arr)->get();
        }
    }
}
