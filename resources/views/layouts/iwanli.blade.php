
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>晚黎学院_laravel免费视频教程下载_laravel5学习基地</title>
    
    <meta name="keywords" content="晚黎学院_laravel免费视频教程下载_laravel5学习基地_专注Laravel技术分享" />
    <meta name="description" content="晚黎学院_laravel免费视频教程下载_laravel5学习基地_专注Laravel技术分享">
    <meta name="author" content="iwanli.me">

    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
</head>
<body class="animsition">

<div class="wrapper">
    
    <header class="header-center-aligned-transparent navbar-fixed-top header-sticky auto-hiding-navbar">
        <!-- Search Field -->
        <div class="search-field">
            <div class="container">
                <input type="text" class="form-control search-field-input" placeholder="Search for...">
            </div>
        </div>

        <nav class="navbar mega-menu" role="navigation">
            <div class="container">
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="toggle-icon"></span>
                    </button>

                    <div class="navbar-actions">

                        <!-- Search Fullscreen -->
                        <div class="navbar-actions-shrink search-fullscreen search-fullscreen-trigger-white">
                            <div class="search-fullscreen-trigger">
                                <i class="search-fullscreen-trigger-icon fa fa-search"></i>
                            </div>
                            <div class="search-fullscreen-overlay">
                                <div class="search-fullscreen-overlay-content">
                                    <div class="search-fullscreen-input-group">
                                        <input type="text" class="form-control search-fullscreen-input" placeholder="Search for ...">
                                        <button class="search-fullscreen-search" type="button"><i class="search-fullscreen-search-icon fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="search-fullscreen-bg-overlay">
                                <div class="search-fullscreen-close">&times;</div>
                            </div>
                        </div>
                        <!-- End Search Fullscreen -->
                    </div>
                    <div class="navbar-logo">
                        <a class="navbar-logo-wrap" href="/">
                            <img class="navbar-logo-img navbar-logo-img-white" src="{{asset('images/logo-white.png')}}" alt="晚黎">
                            <img class="navbar-logo-img navbar-logo-img-dark" src="{{asset('images/logo-dark.png')}}" alt="晚黎">
                        </a>
                    </div>
                </div>

                <div class="collapse navbar-collapse nav-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav navbar-nav-left">
                            <li class="nav-item">
                                <a class="nav-item-child radius-3" href="/">
                                    <i class="fa fa-home"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item-child radius-3" target="_blank" href="http://blog.iwanli.me">
                                    <i class="fa fa-diamond"></i>
                                    晚黎博客
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-nav-right">
                            <li class="nav-item">
                                <a class="nav-item-child " href="/course"><i class="fa fa-list"></i> 视频列表</a>
                            </li>
                            <li class="nav-item form-modal-nav">
                                <a class="nav-item-child form-modal-login radius-5" href="javascript:void(0);"><i class="fa fa-user"></i> 登录</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    
    @yield('content')


    @include('layouts.iwanli.footer')
</div>

<div class="sidebar-content-overlay"></div>

<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme"></a>

<!--[if lt IE 9]>
<script src="/static/bitnew/js/html5shiv.js"></script>
<script src="/static/bitnew/js/respond.min.js"></script>
<![endif]-->
<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
