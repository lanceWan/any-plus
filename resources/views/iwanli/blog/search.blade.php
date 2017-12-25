@extends('layouts.blog')
@section('content')
@inject('presenter', 'App\Repositories\Presenters\Iwanli\BlogPresenter')
<section class="breadcrumbs-v5">
    <div class="container">
        <h2 class="breadcrumbs-v5-title">I am Wanli</h2>
        <span class="breadcrumbs-v5-subtitle">I am a slow walker, but I never walk backwards...</span>
    </div>
</section>
<section class="breadcrumbs-v1">
    <div class="container">
        <h2 class="breadcrumbs-v1-title">搜索：{{request('q', '')}}</h2>
        <ol class="breadcrumbs-v1-links">
            <li><a href="/">Home</a></li>
            <li class="active">{{request('q', '')}}</li>
        </ol>
    </div>
</section>
<div class="bg-color-sky-light">
    <div class="content-xs container">
        <div class="row">
            <div class="col-xs-12 col-md-9 no-space">
                {!! $presenter->articleList($articles) !!}
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="blog-sidebar margin-b-30">
                    <div class="blog-sidebar-heading">
                        <i class="blog-sidebar-heading-icon fa fa-fire"></i>
                        <h4 class="blog-sidebar-heading-title">热门文章</h4>
                    </div>
                    <div class="blog-sidebar-content">
                        <ul class="timeline-v2">
                            <li class="timeline-v2-list-item">
                                <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                <small class="timeline-v2-news-date">2017-03-15 17:23:05</small>
                                <h5 class="timeline-v2-news-title"><a href="http://blog.iwanli.me/article/yJAWgAWo.html">Vue中使用JavaScript加密库crypto-js</a></h5>
                            </li>                
                            <li class="timeline-v2-list-item">
                                <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                <small class="timeline-v2-news-date">2017-07-11 13:26:26</small>
                                <h5 class="timeline-v2-news-title"><a href="http://blog.iwanli.me/article/Q1Nbx3DB.html">Laravel5.5新特性-安装篇</a></h5>
                            </li>                
                            <li class="timeline-v2-list-item">
                                <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                <small class="timeline-v2-news-date">2017-08-04 15:36:32</small>
                                <h5 class="timeline-v2-news-title"><a href="http://blog.iwanli.me/article/k7NxlNJY.html">Any-基于 Laravel5.4 新的权限管理后台骨架</a></h5>
                            </li>                
                            <li class="timeline-v2-list-item">
                                <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                <small class="timeline-v2-news-date">2017-06-14 12:03:31</small>
                                <h5 class="timeline-v2-news-title"><a href="http://blog.iwanli.me/article/er3Go3Gl.html">Laravel 5 中使用 JWT（Json Web Token） </a></h5>
                            </li>                
                            <li class="timeline-v2-list-item">
                                <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                                <small class="timeline-v2-news-date">2017-04-06 15:16:39</small>
                                <h5 class="timeline-v2-news-title"><a href="http://blog.iwanli.me/article/wr9Em9mL.html">l5-repository在Laravel中使用安装篇</a></h5>
                            </li>
                            <li class="clearfix" style="float: none;"></li>
                        </ul>
                    </div>
                </div>                    
                @include('layouts.iwanli.link', ['presenter' => $presenter])                                
            </div>
        </div>
    </div>
</div>

{{ $articles->fragment('scroll')->links('pagination::iwanli') }}

@endsection