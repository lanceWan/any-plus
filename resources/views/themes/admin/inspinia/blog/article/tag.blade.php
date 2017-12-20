<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">创建标签</h4>
</div>
<div class="modal-body">
  <form method="post" action="{{route('tag.store')}}" class="form-horizontal" id="createTag">
      {!!csrf_field()!!}
      <div class="form-group">
        <label class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="名称" name="name">
        </div>
      </div>
    </form>
</div>
<div class="modal-footer">
  <a href="javascript:;" class="btn btn-primary createTag">创建</a>
  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>

<script type="text/javascript">
  $(document).on('click', '.createTag', function () {
    var _form = $('#createTag');
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
        var _tagsSelect = $('select.tagsSelect');
        _tagsSelect.append('<option value="'+ response.data.id +'">'+ response.data.name +'</option>');
        var selected =  _tagsSelect.selectpicker('val') || [];
        selected.push(response.data.id)
        _tagsSelect.selectpicker('val', selected);
        _tagsSelect.selectpicker('refresh');
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