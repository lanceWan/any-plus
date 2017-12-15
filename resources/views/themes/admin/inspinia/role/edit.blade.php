@extends('layouts.'.getTheme())
@section('css')
<link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@section('content')
@inject('presenter','App\Repositories\Presenters\Admin\RolePresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>角色管理</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">控制台</a>
        </li>
        <li>
            <a href="{{route('role.index')}}">角色列表</a>
        </li>
        <li class="active">
            <strong>编辑角色</strong>
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
          <h5>编辑【{{$role->name}}】角色</h5>
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
          @include('flash::message')
          <form method="post" action="{{route('role.update',[encodeId($role->id)])}}" class="form-horizontal">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">名称</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old('name', $role->name)}}" placeholder="名称"> 
                @if ($errors->has('name'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">角色</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="slug" value="{{old('slug', $role->slug)}}" placeholder="角色"> 
                @if ($errors->has('slug'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('slug') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">描述</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old('description', $role->description)}}" placeholder="描述">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">角色权限</label>
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
                      {!! $presenter->permissionList($permissions, array_column($role->permissions->toArray(),'id')) !!}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{url()->previous()}}">返回</a>
                  @if(haspermission('rolecontroller.store'))
                  <button class="btn btn-primary" type="submit">保存</button>
                  @endif
              </div>
            </div>
          </form>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset(getThemeAssets('iCheck/icheck.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('js/check.js'))}}"></script>
@endsection