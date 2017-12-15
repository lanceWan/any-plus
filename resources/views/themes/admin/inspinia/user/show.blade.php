@extends('layouts.'.getTheme())
@section('css')
<link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@section('content')
@inject('presenter','App\Repositories\Presenters\Admin\System\UserPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>用户管理</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">控制台</a>
        </li>
        <li>
            <a href="{{route('user.index')}}">用户列表</a>
        </li>
        <li class="active">
            <strong>查看用户</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a class="btn btn-white" href="{{url()->previous()}}"><i class="fa fa-reply"></i>  返回</a>
    </div>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>查看【{{$user->name}}】信息</h5>
          <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
              <a class="close-link">
                  <i class="fa fa-times"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">呢称</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->name}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->username}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">邮箱</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->email}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">用户角色</label>
              <div class="col-sm-10">
                {!!$presenter->showUserRoles($user->roles)!!}
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">额外权限</label>
              <div class="col-sm-10">
                <div class="ibox float-e-margins">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th class="col-md-1 text-center">模块</th>
                          <th class="col-md-10 text-center">权限</th>
                      </tr>
                    </thead>
                    <tbody>
                      {!! $presenter->showUserPermissions($user->userPermissions) !!}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{url()->previous()}}">返回</a>
              </div>
            </div>
          </form>
        </div>
    </div>
  	</div>
  </div>
</div>
@include('layouts.partials.modal')
@endsection
@section('js')
<script type="text/javascript" src="{{asset(getThemeAssets('iCheck/icheck.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('js/check.js'))}}"></script>
@endsection