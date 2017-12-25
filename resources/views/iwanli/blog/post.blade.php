@extends('layouts.blog')
@section('content')
@inject('presenter', 'App\Repositories\Presenters\Iwanli\BlogPresenter')
<section class="breadcrumbs-v5">
    <div class="container text-center">
        <h1 class="breadcrumbs-v5-post">{{$article->title}}</h1>
        <p class="breadcrumbs-v5-divider">热度：{{$article->view or '（￣▽￣）'}} ℃</p>
    </div>
</section>
<div class="bg-color-sky-light">
    <div class="content-xs container">
        <div class="row">
            <div class="col-xs-12 col-md-9 no-space">
                <article class="blog-grid">
                    <div class="blog-grid-content article margin-b-30">
                        @if($article->banner)
                        <img class="img-responsive margin-b-10" src="{{$article->banner}}" alt="{{$article->title}}">
                        @endif
                        {!! $article->content_html !!}

                        <hr>
                        <span class="blog-single-post-source">Source: <a href="{{ request()->fullUrl()}}">{{ request()->fullUrl()}}</a></span>
                    </div>

                    <div class="bg-color-white">
                        <div class="blog-single-post-content">
                            <div class="heading-v1 text-center margin-b-30" style="padding: 0 15px">
                                <h2 class="heading-v1-title">Leave a comment</h2>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="blog-sidebar margin-b-30">
                    <div class="blog-sidebar-content scrollbar">
                        <h3 class="portfolio-item-subitem-title">Published</h3>
                        <p class="portfolio-item-subitem-paragraph">{{$article->created_at}}</p>
                        <hr>
                        <h3 class="portfolio-item-subitem-title">Categories</h3>
                        <ul class="list-unstyled tags-v2 margin-b-20">
                            {!! $presenter->postDetailCategories($article->category) !!}
                        </ul>
                        <hr>
                        <h3 class="portfolio-item-subitem-title">Tags</h3>
                        <ul class="list-unstyled tags-v2 margin-b-20">
                            {!! $presenter->postDetailTags($article->tag) !!}
                        </ul>
                    </div>
                </div>
                @include('layouts.iwanli.link', ['presenter' => $presenter])
            </div>

        </div>
    </div>
</div>
@endsection