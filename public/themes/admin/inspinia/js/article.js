$(function () {

    $('.selectpicker').selectpicker({
  		showSubtext:true
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
    $('.tooltips').tooltip( {
      placement : 'top',
      html : true
    });
});