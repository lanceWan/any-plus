@extends('layouts.'.getTheme())
@section('content')
@inject('presenter', 'App\Repositories\Presenters\Admin\System\UserPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>用户管理</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin')}}">控制台</a>
        </li>
        <li class="active">
            <strong>用户列表</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      @if(haspermission('permissioncontroller.create'))
      <a href="{{route('user.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> 创建用户</a>
      @endif
    </div>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-title">
          <h5>用户列表</h5>
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
          <div class="row">
            <form action="{{url('admin/permission')}}">
              <div class="col-sm-4 col-md-offset-8 m-b-md">
                  <div class="input-group">
                    <input type="text" name="name" placeholder="Search" value="{{request('name', '')}}" class="input-sm form-control"> 
                    <span class="input-group-btn"><button type="submit" class="btn btn-sm btn-primary"> 搜索 !</button> </span>
                    </div>
              </div>
            </form>
          </div>
          <table class="table table-bordered table-responsive no-margins">
            <thead>
            <tr>
                <th>#</th>
                <th>呢称</th>
                <th>用户名</th>
                <th>创建时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
              @if($users->isNotEmpty())
              @foreach($users as $key => $v)
              <tr>
                  <td>{{encodeId($v->id)}}</td>
                  <td>{{$v->name}}</td>
                  <td>{{$v->username}}</td>
                  <td>{{$v->created_at}}</td>
                  <td>{{$v->updated_at}}</td>
                  <td>{!! $presenter->getActionButtonAttribute($v->id) !!}</td>
              </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="6" class="text-center">暂无数据</td>
                </tr>
              @endif
            </tbody>
          </table>
          <div class="row">
            {!! $presenter->paginationInfo($users) !!}
            <div class="col-sm-4 col-md-offset-4 m-b-xs text-right">
              {{$users->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
  <script src="{{asset(getThemeAssets('layer/layer.js', true))}}"></script>
  <script type="text/javascript">
    $(document).on('click','.destroy_item',function() {
      var _item = $(this);
      var title = "确定删除该数据？";
      layer.confirm(title, {
        btn: ['确定', '取消'],
        icon: 5
      },function(index){
        _item.children('form').submit();
        layer.close(index);
      });
    });
    $('.tooltips').tooltip( {
      placement : 'top',
      html : true
    });
  </script>
@endsection