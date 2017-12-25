@extends('layouts.blog')
@section('content')
@inject('presenter', 'App\Repositories\Presenters\Iwanli\BlogPresenter')
<div class="promo-block-v2 fullheight text-center">
    <div class="container vertical-center-aligned">
        <h1 class="promo-block-v2-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">Welcome To iWanli's Blog</h1>
        <p class="promo-block-v2-text margin-b-50 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".5s">
            I am a slow walker, but I never walk backwards...
        </p>
        <div class="scroll-to-section-v1 wow fadeInUp pull-right" data-wow-duration="1.5s" data-wow-delay="1.5s">
            <a href="#scroll_page">
                <i class="scroll-to-section-click-icon fa fa-angle-double-down"></i>
            </a>
        </div>
    </div>
</div>
<div class="bg-color-sky-light">
    <div class="container-sm">
        <div class="bg-color-white border-1 padding-40 margin-t-o-80">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-v1 margin-b-20 text-center">
                        <h2 class="heading-v1-title">Story About Me</h2>
                        <span class="heading-v1-subtitle">碎碎念念的话，伴随着成长</span>
                    </div>
                    <p>时间真的好快，嗖的一下就长成了今天这模样。永远不会像《挪威森林》村上写的那一句话：一直以为十八岁之后是十九岁，十九岁后是十八岁，如此反复。如今说好的十八岁离开好几年了，好宅不代表着我老，如果认真的去做的更好，只是个开始。如今过的日子并不好过的话，完全可以付出更多的努力再来活一次，找到真正想要的自己。</p><p>执着的去做，不怕舍不得睡觉、玩乐、安逸的时间去拼，要知道现在的痛苦和难受都是以前放弃了太多努力。所以现在要抓紧努力，哪怕需要你花全部精力。去拼，如果没有天分，就用时间去换，走得再慢也不要后退。希望再过几年真的被喊叔叔的年纪，那时候回头感谢一下现在选择拼搏的我。</p><p>没有天分，就用时间去换......</p>
                </div>
            </div>
        </div>
        <div class="content"></div>
    </div>
</div>

<div class="bg-color-white">
    <div class="content-md container" id="scroll">
        <div class="heading-v3 text-center">
            <h2 class="heading-v3-title">Great Diary</h2>
            <div class="divider-v2"><div class="divider-v2-element"><i class="divider-v2-icon fa fa-paper-plane-o"></i></div></div>
            <p class="heading-v3-text">It's the small details that will make a big difference</p>
        </div>
    </div>
</div>
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