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
<?php if(isset($_GET['active_del'])):?>
<div class="alert alert-success">删除标签成功</div><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-success">修改标签成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">请选择要删除的标签</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div class="tab-pane fade active in" role="tabpanel">
<form action="tag.php?action=dell_all_tag" method="post" name="form_tag" id="form_tag">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0">
<thead>
  <tr>
<th class="tdcenter">#</th>
<th>名称</th>
<th class="tdcenter">操作</th>
</tr>
</thead>
<tbody>
<?php 
if($tags):
foreach($tags as $key=>$value): ?>	
  <tr>
<td class="tdcenter" style="width:30px">
<input type="checkbox" name="tag[<?php echo $value['tid']; ?>]" class="ids" value="1" >
</td>
<td>
<?php echo $value['tagname']; ?>
</td>
<td style="width:80px" class="tdcenter"  id="taga">
<a href="tag.php?action=mod_tag&tid=<?php echo $value['tid']; ?>">编辑</a>
</td>
</td>
 <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="3"> 还没有标签，写文章的时候可以给文章打标签 </td></tr>
    <?php endif;?>
</tbody>
</table>										
</div>
</div>
<div class="clearfix"></div>	
<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <div class=" form-group form-inline" style="padding-top:10px">
    操作: 
<a href="javascript:void(0);" id="select_all">全选</a> | 
<a href="javascript:deltags();" class="care">删除</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
selectAllToggle();
function deltags(){
	if (getChecked('ids') == false) {
		alert('请选择要删除的标签');
		return;
	}
	if(!confirm('你确定要删除所选标签吗？')){return;}
	$("#form_tag").submit();
}
setTimeout(hideActived,2600);
$("#menu_tag").addClass('active');
</script>
