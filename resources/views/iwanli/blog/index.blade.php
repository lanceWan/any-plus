@extends('layouts.blog')
@section('content')
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
                @if($articles->isNotEmpty())
                @foreach($articles as $v)
                <div class="col-md-12 grid-item">
                    <article class="blog-grid">
                        <div class="blog-grid-box-shadow">
                            <div class="blog-grid-content">
                                <h2 class="blog-grid-title-md"><a href="http://blog.iwanli.me/article/k7NxlNJY.html">{{$v->title}}</a></h2>
                                
                                <p>{!! $v->lead !!}</p>
                            </div>
                            <div class="blog-grid-supplemental">
                                <span class="blog-grid-supplemental-title">
                                    <i class="fa fa-leaf"></i><a class="blog-grid-supplemental-category" href="http://blog.iwanli.me/category/KpAVO3xg.html"> Laravel</a> - <i class="fa fa-clock-o"></i> {{$v->created_at}}
                                </span>
                                <span class="blog-grid-supplemental-title pull-right">
                                    <i class="fa fa-fire"></i> {{$v->views}}
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach           
                @endif
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
                <div class="blog-sidebar margin-b-30">
                    <div class="blog-sidebar-heading">
                        <i class="blog-sidebar-heading-icon fa fa-link"></i>
                        <h4 class="blog-sidebar-heading-title">友情链接</h4>
                    </div>
                    <div class="blog-sidebar-content">
                        <ul class="list-unstyled lists-base">
                            <li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="https://laravel-china.org/">Laravel China社区</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="http://laravelacademy.org/">Laravel学院</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="https://aabvip.com/">Destiny</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="http://www.humengxu.com/">小胡发掘网</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="http://www.haoyuqi.top/">郝瑜琦博客</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="http://www.php01.com/">黄宽的博客</a></li><li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="https://www.blueeye.cc">BLUE个人博客</a></li>
                        </ul>
                    </div>
                </div>                                
            </div>
        </div>
    </div>
</div>
<div class="bg-color-sky-light">
    <div class="content-xs container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="paginations-v2 text-center">
                    <ul class="paginations-v2-list">
                        <li class="disabled"><span>&laquo;</span></li>     
                        <li class="active"><span>1</span></li>  
                        <li><a href="http://blog.iwanli.me?page=2#scroll">2</a></li>
                        <li><a class="page-link" href="http://blog.iwanli.me?page=2#scroll" rel="next">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection