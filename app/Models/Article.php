<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['video_id', 'user_id', 'title', 'lead', 'banner', 'content_html', 'content_mark', 'meta_title', 'meta_keyword', 'meta_description', 'view', 'status'];

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsToMany('App\Models\Category','article_category','article_id','category_id')->withTimestamps();
    }
}
