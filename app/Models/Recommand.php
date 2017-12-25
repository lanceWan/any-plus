<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommand extends Model
{
    protected $fillable = ['article_id', 'title', 'push_at', 'score'];
}
