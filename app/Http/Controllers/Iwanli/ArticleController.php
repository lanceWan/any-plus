<?php

namespace App\Http\Controllers\Iwanli;

use App\Http\Controllers\Controller;
use App\Services\Iwanli\ArticleService;

class ArticleController extends Controller
{
	protected $service;

	public function __construct(ArticleService $service)
	{
		$this->service = $service;
	}

    public function index()
    {
    	$articles = $this->service->index();
    	return view('iwanli.blog.index')->with(compact('articles'));
    }
}
