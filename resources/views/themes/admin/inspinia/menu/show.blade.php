@inject('menuPresenter','App\Repositories\Presenters\Admin\MenuPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="showBox">
  <div class="ibox-title">
    <h5>查看菜单信息</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal" id="showForm">
      <div class="form-group">
        <label class="col-sm-3 control-label">名称</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->name}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">层级</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menuPresenter->topMenuName($menus,$menu->pid)}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">图标</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{empty($menu->icon) ? '' : '<i class="'.$menu->icon.'"></i>'}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">权限</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->slug}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">连接地址</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->url}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">高亮地址</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->active}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">描述</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->description}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">排序</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$menu->sort}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
              <a class="btn btn-white close-link">关闭</a>
          </div>
      </div>
    </form>
  </div>
</div>