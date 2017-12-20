@inject('presenter','App\Repositories\Presenters\Admin\Blog\CategoryPresenter')
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">创建分类</h4>
</div>
<div class="modal-body">
  <form method="post" action="{{route('category.store')}}" class="form-horizontal" id="createCategory">
      {!!csrf_field()!!}
      <div class="form-group">
        <label class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="名称" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">层级</label>
        <div class="col-sm-10">
          <select  data-live-search="true" class="selectpicker form-control" name="pid">
            {!!$presenter->topCategoryList($categories)!!}
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">图标</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="图标" value="" name="icon">
          <span class="help-block m-b-none">更多图标请查看 <a href="http://fontawesome.io/icons/" target="_black">Font Awesome</a></span>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">连接地址</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="连接地址" value="" name="url">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
          <input type="text" id="sort"  name='sort' class="form-control"/>
        </div>
      </div>
    </form>
</div>
<div class="modal-footer">
  <a href="javascript:;" class="btn btn-primary createCategory">创建</a>
  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>

<script type="text/javascript">
  $('.selectpicker').selectpicker();
  $('#sort').ionRangeSlider({
      type: "single",
      min: 0,
      max: 100,
      from: 0
  });
  $(document).on('click', '.createCategory', function () {
    var _form = $('#createCategory');
    $.ajax({
      url: _form.attr('action'),
      type: 'post',
      dataType:'json',
      data:_form.serializeArray(),
      headers : {
        'X-CSRF-TOKEN': $("input[name='_token']").val()
      },
      success:function (response) {
        layui.use('layer', function(){
          var layer = layui.layer;
          
          layer.msg(response.message);
        });
        $('#myModal').modal('toggle');
        $('select.category_id').append('<option value="'+ response.data.id +'">'+ response.data.name +'</option>');
        var selected =  $('select.category_id').selectpicker('val');
        $('.category_id').selectpicker('refresh');
        selected.push(response.data.id)
        $('select.category_id').selectpicker('val', selected);
      }
    }).fail(function(response) {
      if(response.status == 422){
        var data = response.responseJSON.errors;
        var layerStr = "";
        for(var i in data){
          layerStr += "<div>"+data[i]+"</div>";
        }
        layui.use('layer', function(){
          var layer = layui.layer;
          layer.msg(layerStr);
        });
      }
    });
  });
</script>