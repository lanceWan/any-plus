<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;

use App\Http\Requests\Blog\ArticleRequest;
use App\Services\Admin\Blog\ArticleService;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->service->index();
        return view(getThemeView('blog.article.list'))->with(compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->service->create();
        return view(getThemeView('blog.article.create'))->with($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->service->edit($id);
        if (!$result) {
            return redirect()->route('article.index');
        }
        return view(getThemeView('blog.article.edit'))->with($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createCategory()
    {
        $categories = $this->service->createCategory();
        return view(getThemeView('blog.article.category'))->with(compact('categories'));
    }

    public function createTag()
    {
        return view(getThemeView('blog.article.tag'));
    }
}
