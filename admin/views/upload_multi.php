<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>upload</title>
<link href="./views/app/css/css-uploadify.css?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/css" rel="stylesheet">
<link href="./views/app/css/css-att.css?v=<?php echo Option::EMLOG_VERSION; ?>" type=text/css rel=stylesheet>
<script>
function showupload(multi){
	var as_logid = parent.document.getElementById('as_logid').value
	window.location.href="attachment.php?action=selectFile&logid="+as_logid+"&multi="+multi;	
}
function showattlib(){
	var as_logid = parent.document.getElementById('as_logid').value
	window.location.href="attachment.php?action=attlib&logid="+as_logid;	
}
</script>
 <script src="../include/lib/js/jquery/jquery-1.11.0.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="../include/lib/js/jquery/plugin-cookie.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./views/app/js/common.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
</head>
<body>
<div id="media-upload-header">
	<span><a href="javascript:showupload(0);">上传附件</a></span>
	<span id="curtab"><a href="javascript:showupload(1);">批量上传</a></span>
	<span><a href="javascript:showattlib();">附件库（<?php echo $attachnum; ?>）</a></span>
</div>
<?php 
if(true === isIE6Or7()): ?>
<div class="ie_notice">您正在使用的浏览器版本太低，无法使用批量上传功能。为了更好的使用emlog，建议您升级浏览器或者换用其他浏览器。</div>
<?php else:?>
<form enctype="multipart/form-data" method="post" name="upload" action="">
<div id="media-upload-body">
<div id="custom-queue" class="uploadifyQueue"></div>
</div>
</form>
<script type="text/javascript" src="./views/app/js/upload.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script>
$(document).ready(function() {
$(function(){
	var up = $('#custom-queue').Huploadify({
		auto:true,
		fileTypeExts: '<?php echo $att_type_for_muti;?>',
		multi:true,
		formData:{key:'<?php echo AUTH_COOKIE_NAME;?>',key2:'<?php echo $_COOKIE[AUTH_COOKIE_NAME];?>'},
		fileSizeLimit	: 20971520,
		fileObjName     : 'attach',
		showUploadedPercent:true,
		showUploadedSize:true,
		buttonText:'选择文件',
		removeTimeout:9999999,
		uploader:'attachment.php?action=upload_multi&logid='+parent.document.getElementById('as_logid').value,
		onQueueComplete:function(queueData){
			showattlib();
		}
	});
});
});
</script>
<?php endif; ?>
</body>
</html>
