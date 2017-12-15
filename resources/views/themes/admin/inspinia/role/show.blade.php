@inject('presenter','App\Repositories\Presenters\Admin\RolePresenter')
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">查看角色信息</h4>
</div>
@if($role)
<div class="modal-body">
  <form class="form-horizontal">
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">名称</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->name}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">角色</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->slug}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">描述</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->description}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">创建时间</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->created_at}}</p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <div class="ibox float-e-margins">
          <div class="ibox-content">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th class="col-md-2 text-center">模块</th>
                <th class="col-md-10 text-center">权限</th>
              </tr>
              </thead>
              <tbody>
                {!!$presenter->showRolePermissions($role->permissions)!!}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@else
<div class="modal-body">
  <p class="text-center">获取角色信息失败</p>
</div>
@endif
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>