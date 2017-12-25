<?php

namespace App\Http\Controllers\Iwanli;

use App\Http\Controllers\Controller;
use App\Services\Iwanli\ArticleService;

class IndexController extends Controller
{
    public function index()
    {
    	return view('iwanli.index');
    }

    public function search()
    {
    	$service = new ArticleService;
    	$articles = $service->index(request('q', ''));
    	return view('iwanli.blog.search')->with(compact('articles'));
    }
}
