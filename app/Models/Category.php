<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article','article_category','category_id','article_id')->withTimestamps();
    }
}
