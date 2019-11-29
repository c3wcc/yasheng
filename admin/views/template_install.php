<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class="content_tab">
<div class="tab_left">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-left"></i></a>
</div>
<div class="tab_right">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-right"></i></a>
</div>
<ul id="tabs" class="tabs">
<li id="tab_home">
<a href="./" class="waves-effect waves-light">首页</a>
</li>
<li id="tab_temp" class="cur">
<a href="template.php" class="waves-effect waves-light"> 模板管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['error_a'])):?>
<div class="alert alert-danger">只支持zip压缩格式的模板包</div>
<?php endif;?>
<?php if(isset($_GET['error_b'])):?>
<div class="alert alert-danger">上传失败，模板目录(content/templates)不可写</div>
<?php endif;?>
 <?php if(isset($_GET['error_c'])):?>
<div class="alert alert-danger">空间不支持zip模块，请按照提示手动安装模板</div>
<?php endif;?>
<?php if(isset($_GET['error_d'])):?>
<div class="alert alert-danger">请选择一个zip模板安装包</div>
<?php endif;?>
 <?php if(isset($_GET['error_e'])):?><div class="alert alert-danger">安装失败，模板安装包不符合标准</div>
<?php endif;?>
<?php if(isset($_GET['error_c'])): ?>
<div style="margin:20px 20px;">
<div class="alert alert-danger">
手动安装模板： <br />
1、把解压后的模板文件夹上传到 content/templates目录下。 <br />
2、登录后台换模板，模板库中已经有了你刚才添加的模板，点击使用即可。 <br />
</div>
</div>
<?php endif; ?>
</div>
</div>
<div class="panel panel-default panel-tabs">
<div class="panel-heading">
<div class="pull-left">
<ul role="tablist" class="nav nav-tabs">
<li class="" role="presentation"> <a href="./template.php">模板管理</a>
</li>
<li role="presentation" class="active"> <a href="template.php?action=install">安装模板</a> </li>
</ul>
</div>	
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="tab-content">						
<div class="tab-pane fade active in" role="tabpanel">
<div class="table-wrap ">
<div class="table-responsive">					
<form action="./template.php?action=upload_zip" method="post" enctype="multipart/form-data" >
<div style="margin:50px 0px 50px 20px;">
    <p>上传一个zip压缩格式的模板安装包</p>
    <p>
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <input name="tplzip" type="file" />
    </p>
    <p>
    <input type="submit" value="上传安装" class="btn btn-primary" />
    </p>
</div>
</form>
<div style="margin:10px 20px;">获取更多模板：<a href="store.php">在线商店&raquo;</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
$("#menu_tpl").addClass('active');
</script>