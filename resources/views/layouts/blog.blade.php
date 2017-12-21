
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
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
</head>
<body class="animsition">
<div class="wrapper">
    <header class="header-transparent header-transparent-bb navbar-fixed-top header-sticky">
        <nav class="navbar mega-menu" role="navigation">
            <div class="container">
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="toggle-icon"></span>
                    </button>

                    <div class="navbar-actions">

                        <div class="navbar-actions-shrink search-fullscreen search-fullscreen-trigger-white">
                            <div class="search-fullscreen-trigger">
                                <i class="search-fullscreen-trigger-icon fa fa-search"></i>
                            </div>
                            <div class="search-fullscreen-overlay">
                                <form action="http://blog.iwanli.me/search" method="post">
                                    <input type="hidden" name="_token" value="kyRF4nzJN5lrFH1nxF8ybtBkntOOeCwslY8WioIB">
                                    <div class="search-fullscreen-overlay-content">
                                        <div class="search-fullscreen-input-group">
                                            <input type="text" class="form-control search-fullscreen-input" name="q" placeholder="Search for ...">
                                            <button class="search-fullscreen-search" type="submit"><i class="search-fullscreen-search-icon fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="search-fullscreen-bg-overlay">
                                <div class="search-fullscreen-close">×</div>
                            </div>
                        </div>
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
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-item-child radius-3" target="_blank" href="http://blog.iwanli.me">
                                <i class="fa fa-home"></i> Home
                                </a>
                            </li>                    
                            <li class="nav-item dropdown">
                                <a class="nav-item-child dropdown-toggle radius-3" href="javascript:void(0);" data-toggle="dropdown">
                                    <i class="fa fa-diamond"></i> PHP
                                </a>
                                <ul class="dropdown-menu">            
                                    <li class="dropdown-menu-item">
                                        <a class="dropdown-menu-item-child"  href="http://blog.iwanli.me/category/KpAVO3xg.html">Laravel</a>
                                    </li>            
                                    <li class="dropdown-menu-item">
                                        <a class="dropdown-menu-item-child"  href="http://blog.iwanli.me/category/B19QWAlk.html">Mysql</a>
                                    </li>
                                </ul>
                            </li>                    
                            <li class="nav-item">
                                <a class="nav-item-child radius-3"  href="http://blog.iwanli.me/category/JeNXJ3Vj.html">
                                随笔
                                </a>
                            </li>                    
                            <li class="nav-item">
                                <a class="nav-item-child radius-3" target="_blank" href="https://github.com/lanceWan">
                                    <i class="fa fa-github"></i> Github
                                </a>
                            </li>                    
                            <li class="nav-item">
                                <a class="nav-item-child radius-3" target="_blank" href="http://coding.iwanli.me">
                                <i class="fa fa-free-code-camp"></i> Laravel学院
                                </a>
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
<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme back-to-top-is-visible"></a>

<div style="display: none;" class="search-fullscreen-overlay-show animsition-loading animsition-overlay-slide fade-in fade-out is-visible is-selected"></div>

<!--[if lt IE 9]>
<script src="/js/html5shiv.js"></script>
<script src="/js/respond.min.js"></script>
<![endif]-->
<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>