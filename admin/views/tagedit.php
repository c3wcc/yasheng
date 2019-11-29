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
<li id="tab_tag" class="cur">
<a href="tag.php" class="waves-effect waves-light">标签管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">标签不能为空</div><?php endif;?>
</div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑标签
        </div>
<div class="panel-body">
<form  method="post" action="tag.php?action=update_tag" class="form-inline">
<div class="form-group">
               <input type="text" value="<?php echo $tagname; ?>" name="tagname" class="form-control" />
            </div>
<div class="form-group">
<input type="hidden" value="<?php echo $tagid; ?>" name="tid" />
<input type="submit" value="保存" class="btn btn-primary" />
<input type="button" value="取消" class="btn btn-default" onclick="javascript: window.location='tag.php';"/>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
$("#menu_tag").addClass('active');</script>

