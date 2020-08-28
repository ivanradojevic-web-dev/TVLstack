<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ReversScope;

class Post extends Model
{
    protected $fillable = [
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    //protected static function booted()	// ::all = all->orderBy("id", "desc")
    //{
    //    static::addGlobalScope(new ReversScope);
    //}
}
