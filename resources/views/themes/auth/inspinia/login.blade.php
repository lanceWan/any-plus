<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>后台登录</title>
  <link rel="stylesheet" type="text/css" href="{{asset(getThemeAssets('css/login.css'))}}" />
  <style>
  body{height:100%;background:#16a085;overflow:hidden;}
  canvas{z-index:-1;position:absolute;}
  </style>
</head>
<body>
<form role="form" method="POST" action="{{url('/admin/login')}}">
  {{ csrf_field() }}
  <dl class="admin_login">
    <dt>
    <strong>站点后台管理系统</strong>
    <em>Management System</em>
    </dt>
    <dd class="user_icon">
    <input type="text" placeholder="账号" name="{{config('iwanli.global.username')}}" class="login_txtbx" value="{{old(config('iwanli.global.username'))}}" />
    @if ($errors->has(config('iwanli.global.username')))
    <dt class="error">
      <em>{{ $errors->first(config('iwanli.global.username')) }}</em>
    </dt>
    @endif
    </dd>
    <dd class="pwd_icon">
    <input type="password" placeholder="密码" name="password" class="login_txtbx" />
    @if ($errors->has('password'))
    <dt class="error">
      <em>{{ $errors->first('password') }}</em>
    </dt>
    @endif
    </dd>
    <dd>
    <input type="submit" value="立即登陆" class="submit_btn"/>
    </dd>
    <dd>
    <p>晚黎后台权限系统</p>
    <p>iwanli</p>
    </dd>
  </dl>
</form>
  <script src="{{asset(getThemeAssets('jquery/jquery-2.1.1.js', true))}}"></script>
  <script src="{{asset(getThemeAssets('Particleground.js', true))}}"></script>
  <script>
  $(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
  dotColor: '#5cbdaa',
  lineColor: '#5cbdaa'
  });
  });
  </script>
</body>
</html>