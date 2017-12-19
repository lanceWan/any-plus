$(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
    });
    $('.selectpicker').selectpicker({
  		showSubtext:true
    });
    $('.tagsinput').tagsinput({
        tagClass: 'label label-primary',
        cancelConfirmKeysOnEmpty:true
    });

  	var editor = editormd('editor',{
		width   : "100%",
		height  : 640,
		syncScrolling : "single",
		toolbarAutoFixed: true,
		gotoLine:false,
		emoji:false,
		autoFocus:false,
		saveHTMLToTextarea:true,
		path    : "/vendors/editor/lib/",
		imageUpload : true,
		imageUploadURL : '/admin/article/upload'
    });

    $('.col-sm-offset-2').on('click','.submit-article',function () {
    	$('form').submit();
    });
});