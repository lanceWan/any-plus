<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article','article_tag', 'tag_id', 'article_id')->withTimestamps();
    }
}
