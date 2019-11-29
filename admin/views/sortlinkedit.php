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
<li id="tab_sortlink" class="cur">
<a href="sortlink.php" class="waves-effect waves-light"> 分类编辑 </a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['error_a'])):?>
<div class="alert alert-success">
分类名称不能为空
</div>
<?php endif;?>
</div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑分类
        </div>
<div class="panel-body">
<form action="sortlink.php?action=update" method="post">
<div class="form-group">
<label>名称</label>
<input type="text" value="<?php echo $linksort_name; ?>" name="linksort_name" id="linksort_name"  class="form-control" />
 </div>
<div class="form-group">
	<input type="hidden" value="<?php echo $linksort_id; ?>" name="linksort_id" />
	<input type="submit" value="保存" class="btn btn-primary" />
	<input type="button" value="取消" class="btn btn-default"  onclick="javascript: window.history.back();" />
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
$("#menu_linksort").addClass('active');
</script>