@extends('layouts.'.getTheme())
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>权限管理</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">控制台</a>
        </li>
        <li>
            <a href="{{route('permission.index')}}">权限列表</a>
        </li>
        <li class="active">
            <strong>编辑权限</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a class="btn btn-white" href="{{route('permission.index')}}"><i class="fa fa-reply"></i>  返回</a>
    </div>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>编辑权限</h5>
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
          <form method="post" action="{{route('permission.update', [encodeId($permission->id)])}}" class="form-horizontal">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">名称</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old('name', $permission->name)}}" placeholder="名称"> 
                @if ($errors->has('name'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">权限</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="slug" value="{{old('slug', $permission->slug)}}" placeholder="权限"> 
                @if ($errors->has('slug'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('slug') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">描述</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old('description', $permission->description)}}" placeholder="描述">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{route('permission.index')}}">返回</a>
                  @if(haspermission('permissioncontroller.update'))
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