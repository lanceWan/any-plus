@extends('layouts.'.getTheme())
@section('css')
<link href="{{asset(getThemeAssets('editor/css/editormd.min.css', true))}}" rel="stylesheet" type="text/css" />
<link href="{{asset(getThemeAssets('layui/css/layui.css', true))}}" rel="stylesheet">
<link href="{{asset(getThemeAssets('bootstrap-select/bootstrap-select.min.css', true))}}" rel="stylesheet">
<link href="{{asset(getThemeAssets('bootstrap-tagsinput/bootstrap-tagsinput.css', true))}}" rel="stylesheet">
<link href="{{asset(getThemeAssets('jasny/jasny-bootstrap.min.css', true))}}" rel="stylesheet">
<link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@inject('presenter', 'App\Repositories\Presenters\Admin\Blog\ArticlePresenter')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2 style="margin-top: 20px;margin-bottom: 10px;">文章管理</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">控制台</a>
        </li>
        <li>
            <a href="{{route('article.index')}}">文章列表</a>
        </li>
        <li class="active">
            <strong>创建文章</strong>
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
    <form method="post" action="{{route('article.store')}}" class="form-horizontal">
      {{csrf_field()}}
      <div class="col-lg-8 col-md-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5><i class="fa fa-plus"></i> 创建文章</h5>
          </div>
          <div class="ibox-content">
            @include('flash::message')
              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="名称"> 
                  @if ($errors->has('title'))
                  <span class="help-block m-b-none text-danger">{{ $errors->first('title') }}</span>
                  @endif
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <label class="col-sm-2 control-label">文章Banner</label>
                <div class="col-sm-3">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                      <img src="{{asset(getThemeAssets('img/no-image.png'))}}">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="banner"></span>
                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                  <!-- <input type="text" class="form-control" name="edit_banner" value="{{old('edit_banner')}}"> -->
                </div>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group{{ $errors->has('content_mark') ? ' has-error' : '' }}">
                <!-- <label class="col-sm-2 control-label">内容</label> -->
                <div class="col-sm-12">
                  <div id="editor"><textarea style="display: none;" name="content_mark">{!!old('content_mark')!!}</textarea></div>
                  @if ($errors->has('content_mark'))
                  <span class="help-block m-b-none text-danger">{{ $errors->first('content_mark') }}</span>
                  @endif
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="ibox">
          <div class="ibox-title">
            <h5><i class="fa fa-th-large"></i> 文章分类</h5>
          </div>
          <div class="ibox-content">
              <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">分类</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <select data-placeholder="请选择文章分类" class="selectpicker form-control" name="category_id[]" multiple="multiple" data-live-search="true">
                      {!!$presenter->categoryList($categories)!!}
                    </select>
                    <span class="input-group-btn"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button> </span>
                    @if ($errors->has('category_id'))
                    <span class="help-block m-b-none text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="ibox">
          <div class="ibox-title">
            <h5><i class="fa fa-list"></i> 文章标签</h5>
          </div>
          <div class="ibox-content">
              <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">标签</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <select data-placeholder="Choose a category..." class="selectpicker form-control" name="tags[]" multiple="multiple" data-live-search="true">
                      {!!$presenter->tagList($tags)!!}
                    </select>
                    <span class="input-group-btn"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button> </span>
                    @if ($errors->has('tags'))
                    <span class="help-block m-b-none text-danger">{{ $errors->first('tags') }}</span>
                    @endif
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="ibox">
          <div class="ibox-title">
            <h5><i class="fa fa-paper-plane-o"></i> 发布</h5>
          </div>
          <div class="ibox-content">
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label"><i class="fa fa-eye"></i> 状态</label>
              <div class="col-sm-10">
                <select class="selectpicker form-control" name="status" >
                  <option value="1">发布</option>
                  <option value="2">草稿</option>
                </select>
                @if ($errors->has('status'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('status') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{url()->previous()}}">返回</a>
                  @if(haspermission('articlecontroller.store'))
                  <button class="btn btn-primary" type="submit">保存</button>
                  @endif
              </div>
            </div>
          </div>
        </div>
        <div class="ibox">
          <div class="ibox-title">
            <h5><i class="fa fa-paw"></i> SEO</h5>
          </div>
          <div class="ibox-content">
            <div class="form-group">
              <label class="col-sm-2 control-label">标题</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">关键字</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_keyword" value="{{old('meta_keyword')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">描述</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="meta_description">{{old('meta_description')}}</textarea>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </form>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset(getThemeAssets('editor/editormd.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('bootstrap-select/bootstrap-select.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('bootstrap-tagsinput/bootstrap-tagsinput.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('jasny/jasny-bootstrap.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('layui/layui.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('iCheck/icheck.min.js', true))}}"></script>
<script type="text/javascript" src="{{asset(getThemeAssets('js/article.js'))}}"></script>
@endsection