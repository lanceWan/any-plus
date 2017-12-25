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
                                   
                @include('layouts.iwanli.hot', ['presenter' => $presenter])
                
                @include('layouts.iwanli.link', ['presenter' => $presenter])
            </div>
        </div>
    </div>
</div>

{{ $articles->fragment('scroll')->links('pagination::iwanli') }}

@endsection