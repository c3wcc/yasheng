<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
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
<a href="sortlink.php" class="waves-effect waves-light"> 友情分类 </a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_taxis'])):?>
<div class="alert alert-success">
排序更新成功
</div>
<?php endif;?>
<?php if(isset($_GET['active_del'])):?>
<div class="alert alert-success">
删除分类成功
</div>
<?php endif;?>
<?php if(isset($_GET['active_edit'])):?>
<div class="alert alert-success">
修改分类成功
</div>
<?php endif;?>
<?php if(isset($_GET['active_add'])):?>
<div class="alert alert-success">
添加分类成功
</div>
<?php endif;?>
<?php if(isset($_GET['error_a'])):?>
<div class="alert alert-success">
分类名称不能为空
</div>
<?php endif;?>
<?php if(isset($_GET['error_b'])):?>
<div class="alert alert-danger alert-dismissable">
没有可排序的分类
</div>
<?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="links" class="tab-pane fade active in" role="tabpanel">
<form  method="post" action="sortlink.php?action=taxis">
<div class="table-wrap ">
<div class="table-responsive">				
<table id="adm_sort_list"  class="table table-striped table-bordered mb-0" id="adm_sort_list">
<thead>
    <tr>
    <th class="tdcenter" style="width:40px"><b>序号</b></th>
    <th><b>分类</b></th>
    <th class="tdcenter" style="width:60px"><b>数量</b></th>
    <th style="width:90px">操作</th>
</tr>
</thead>
<tbody>
<?php if($sortlink):
foreach($sortlink as $key=>$value):?>
<tr>
    <td>
        <input type="hidden" value="<?php echo $value['linksort_id'];?>" class="sort_id" />
        <input maxlength="4" class="form-control  em-small"   name="sortlink[<?php echo $value['linksort_id']; ?>]" value="<?php echo $value['taxis']; ?>" />
    </td>
    <td class="sortname">
        <a href="sortlink.php?action=mod_sortlink&linksort_id=<?php echo $value['linksort_id']; ?>"><?php echo $value['linksort_name']; ?></a>
    </td>
    <td class="tdcenter"><a href="./link.php?linksortid=<?php echo $value['linksort_id']; ?>"><?php echo $value['linknum']; ?></a></td>
    <td>
        <a href="sortlink.php?action=mod_sortlink&linksort_id=<?php echo $value['linksort_id']; ?>" title="编辑">编辑</a>
        <a href="javascript:em_confirm(<?php echo $value['linksort_id']; ?>,'sortlink','<?php echo LoginAuth::genToken(); ?>');" class="care" title="删除">删除</a>
    </td>
</tr>
<?php endforeach;else:?><tr><td class="tdcenter" colspan="8"> 还没有添加分类 </td></tr><?php endif;?>  
</tbody>
</table>
  </div>
  </div>
<div class="list_footer" style="padding-top:10px">
      <input type="submit" value="更改排序" class="btn btn-primary" /> 
      <a href="#addsort" data-toggle="modal" class="btn btn-success">添加分类+</a>
  </div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="addsort" tabindex="-1" role="dialog" aria-labelledby="addsortLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="zmdi zmdi-close"></i> </button>
<h4 class="modal-title" id="addsortLabel">添加分类</h4>
</div>
<div class="modal-body">
<form action="sortlink.php?action=add" method="post" class="form-horizontal" >
 <div class="form-group">
<label class="col-lg-2 control-label">
序号
</label>
<div class="col-lg-10"> 
<input  type="text" maxlength="4" name="taxis"  class="form-control  em-small"/> 
 </div>											
 </div>
 <div class="form-group">
<label class="col-lg-2 control-label">
名称
</label>
<div class="col-lg-10"> 
<input  type="text" name="linksort_name" id="linksort_name" class="form-control" /> 
 </div>											
 </div>
<div class="form-group">
<div class="col-lg-10"> 
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
 <input type="submit" class="btn btn-primary" name="" value="添加"  />
 </div>	
 </div>					
</form>
</div>
</div>
</div>									
</div>
</div>
<script>
$(document).ready(function(){
	$("#adm_sort_list tbody tr:odd").addClass("tralt_b");
	$("#adm_sort_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")});
});
setTimeout(hideActived,2600);
$("#menu_linksort").addClass('active');
</script>


