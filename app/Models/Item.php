<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

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

    public function type()
    {
        return $this->hasOne(Type::class, 'type');
    }

    public function kids()
    {
        return $this->belongsToMany(Item::class, 'child_items', 'parent', 'child');
    }
}
