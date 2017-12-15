@inject('menuPresenter','App\Repositories\Presenters\Admin\MenuPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>编辑菜单信息</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{route('menu.update', [encodeId($menu->id)])}}" class="form-horizontal" id="editForm">
      {!!csrf_field()!!}
      {{method_field('PUT')}}
      <div class="form-group">
        <label class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$menu->name}}" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">层级</label>
        <div class="col-sm-10">
          <select data-live-search="true" class="selectpicker form-control" name="pid">
            {!!$menuPresenter->topMenuList($menus, $menu->pid)!!}
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">图标</label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  value="{{$menu->icon}}" name="icon">
          <span class="help-block m-b-none">更多图标请查看 <a href="http://fontawesome.io/icons/" target="_black">Font Awesome</a></span>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">权限</label>
        <div class="col-sm-10">
          <select data-placeholder="权限" data-live-search="true" class="selectpicker form-control" name="slug">
            {!!$menuPresenter->permissionList($permissions, $menu->slug)!!}
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">连接地址</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$menu->url}}" name="url">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">高亮地址</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$menu->active}}" name="active">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">描述</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$menu->description}}" name="description">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
          <input type="text" id="sort"  name='sort' class="form-control"/>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">关闭</a>
            <button class="btn btn-primary editButton ladda-button"  data-style="zoom-in">编辑</button>
          </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $('.selectpicker').selectpicker();
  $('#sort').ionRangeSlider({
      type: "single",
      min: 0,
      max: 100,
      from: "{{$menu->sort}}"
  });
</script>