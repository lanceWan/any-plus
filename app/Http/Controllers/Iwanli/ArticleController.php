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

    public function show($id)
    {
        $article = $this->service->show($id);
    	return view('iwanli.blog.post')->with(compact('article'));
    }

    public function categoryArticle($id)
    {
        $result = $this->service->categoryArticle($id);
        return view('iwanli.blog.category')->with($result);
    }

    public function tagArticle($id)
    {
        $result = $this->service->tagArticle($id);
        return view('iwanli.blog.tag')->with($result);
    }
}
