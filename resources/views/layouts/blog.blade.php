
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>i晚黎博客</title>
    <meta name="keywords" content="晚黎,博客,Laravel,PHP,框架,教程,资源,学习,笔记,iwanli" />
    <meta name="description" content="i晚黎博客致力于提供优质学习资源,分享个人笔记、视频教程。">
    <meta name="author" content="http://iwanli.me">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    @yield('css')
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
</head>
<body class="animsition">
<div class="wrapper">
    @inject('presenter', 'App\Repositories\Presenters\Iwanli\BlogPresenter') 
    @include('layouts.iwanli.header', ['presenter' => $presenter])

    @yield('content')

    @include('layouts.iwanli.footer')
      
</div>
<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme back-to-top-is-visible"></a>

<div style="display: none;" class="search-fullscreen-overlay-show animsition-loading animsition-overlay-slide fade-in fade-out is-visible is-selected"></div>

<!--[if lt IE 9]>
<script src="/js/html5shiv.js"></script>
<script src="/js/respond.min.js"></script>
<![endif]-->
<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('js')
</body>
</html>