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
<li id="tab_link" class="cur">
<a href="link.php" class="waves-effect waves-light">链接管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_taxis'])):?><div class="alert alert-success">排序更新成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?><div class="alert alert-success">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-success">修改成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-success">添加成功</div><?php endif;?>
<?php if(isset($_GET['active_hide'])):?>
<div class="alert alert-success">显示成功</div>
<?php endif;?>
<?php if(isset($_GET['active_hide_select'])):?>
<div class="alert alert-success">隐藏成功</div>
<?php endif;?>
<?php if(isset($_GET['active_move_select'])):?>
<div class="alert alert-success">移动成功</div>
<?php endif;?>
<?php if(isset($_GET['active_del_select'])):?>
<div class="alert alert-success">删除成功</div>
<?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">站点名称和地址不能为空</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger">没有可排序的链接</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="links" class="tab-pane fade active in" role="tabpanel">
<form action="link.php?action=operate_link" method="post" id="form_link">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0" id="adm_link_list">
<thead>
      <tr>
      <th class="tdcenter"><b>#</b></th>
        <th width="40" class="tdcenter"><b>序号</b></th>
        <th width="230"><b>链接名称</b></th>
        <th width="80" class="tdcenter"><b>状态</b></th>
        <th width="60" class="tdcenter"><b>查看</b></th>
        <th width="400" class="hided"><b>描述</b></th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
if($links):
    foreach($links as $key=>$value):
    $linkSortName = ($value['linksortid'] == -1 || $value['linksortid'] == 0) && !array_key_exists($value['linksortid'], $sortlink) ? '未分类' : $sortlink[$value['linksortid']]['linksort_name'];
    doAction('adm_link_display');
    ?>  
      <tr>
            <td id="link_"><input type="checkbox" name="linkids[]" value="<?php echo $value['id']; ?>" class="ids" />
      </td>
        <td class="tdcenter"><input class="form-control em-small" name="link[<?php echo $value['id']; ?>]" value="<?php echo $value['taxis']; ?>" maxlength="4" /></td>
        <td><a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>" title="修改链接"><?php echo $value['sitename']; ?></a></td>
        <td class="tdcenter">
        <?php if ($value['hide'] == 'n'): ?>
        <a href="link.php?action=hide&amp;linkid=<?php echo $value['id']; ?>" title="点击隐藏链接">显示</a>
        <?php else: ?>
        <a href="link.php?action=show&amp;linkid=<?php echo $value['id']; ?>" title="点击显示链接" style="color:red;">隐藏</a>
        <?php endif;?>
        </td>
        <td class="tdcenter zmdi-lg">
        <a href="<?php echo $value['siteurl']; ?>" target="_blank" title="查看链接">
        <i class="zmdi zmdi-window-restore"></i> </a> </a>
        </td>
        <td class="hided"><?php echo $value['description']; ?></td>
        <td>
        <a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>">编辑</a>
        <a href="javascript: em_confirm(<?php echo $value['id']; ?>, 'link', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
        </td>
      </tr>
    <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="6">还没有添加链接</td></tr>
    <?php endif;?>
    </tbody>
  </table>
  </div>
  </div>
      <div class=" form-group form-inline" style="padding-top:10px">操作: 
<a href="javascript:void(0);" id="select_all">全选</a> | <a href="javascript:linkact('del');" class="care">删除</a> | 
	<a href="javascript:linkact('hide');">隐藏</a> | 
    <a href="javascript:linkact('show');">显示</a> | 
	<select name="linksort" id="linksort" onChange="changeLinkSort(this);" class="form-control" style="width:100px;">
	<option value="" selected="selected">移动到分类...</option>
    <?php foreach($sortlink as $key=>$value):?>
    <option value="<?php echo $value['linksort_id']; ?>"><?php echo $value['linksort_name']; ?></option>
	<?php endforeach;?>
	<option value="-1">未分类</option>
	</select>	
	<select name="bysort" id="bysort" onChange="selectSort(this);" class="form-control" style="width:100px">
            <option value="" selected="selected">按分类查看...</option>
            <?php foreach($sortlink as $key=>$value):$flg = $value['linksort_id'] == $linksortid ? 'selected' : '';?>
            <option value="<?php echo $key; ?>" <?php echo $flg; ?>><?php echo $value['linksort_name']; ?></option>
            <?php endforeach; ?>
            <option value="-1" <?php if($linksortid == -1) echo 'selected'; ?>>未分类</option>
        </select>
</div>
 <div class="list_footer">
  <input type="hidden" name="linksortid" id="linksortid" value="<?php echo $linksortid; ?>" />
  <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
  <input name="operate" id="operate" value="" type="hidden" />
      <input type="submit" id="select_order" value="改变排序" class="btn btn-primary" /> 
      <a href="#addlink" data-toggle="modal" class="btn btn-success">添加链接+</a>
</div>
</form>
<div class="row">
<div class="col-sm-12">
<div class="form-group text-center">
<?php if(!empty($pageurl)){ ?>
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
<?php }?>
<div style="text-align:center;padding-top:10px">
(有<?php echo $linkNum; ?>个链接)
 </div>
</div>                 
</div>
</div>
</div>
</div>
<div class="modal fade" id="addlink" tabindex="-1" role="dialog" aria-labelledby="addlinkLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="zmdi zmdi-close"></i> </button>
<h4 class="modal-title" id="addlinkLabel">添加链接</h4>
</div>
<div class="modal-body">
<form action="link.php?action=addlink" method="post" name="link" class="form-horizontal" id="link">
	<div class="form-group">
<label class="col-lg-2 control-label">序列号</label>
               <div class="col-lg-10"> 
                <input type="text"  name="taxis"    class="form-control  em-small"   >
            </div>											</div>
<div class="form-group">
<label class="col-lg-2 control-label">名称</label>
               <div class="col-lg-10"> 
                <input type="text"  name="sitename"    class="form-control"   >
            </div>											</div>
<div class="form-group">
<label class="col-lg-2 control-label">地址</label>
               <div class="col-lg-10"> 
                <input type="url"  id="url" name="siteurl"    class="form-control"   >
            </div>											</div>
 <div class="form-group">
<label class="col-lg-2 control-label">图标</label>
               <div class="col-lg-10"> 
                <input type="text"  id="pic" name="sitepic"    class="form-control"   >
            </div>											</div>
 <div class="form-group">
<label class="col-lg-2 control-label">分类</label>
 <div class="col-lg-10">             
 <select name="linksortid" id="linksortid" class="form-control">
        <option value="-1">无分类</option>
        <?php foreach($sortlink as $key=>$value):?>
        <option value="<?php echo $key; ?>"><?php echo $value['linksort_name']; ?></option>
        <?php endforeach; ?>
    </select>      
                  </div>											</div>   
            	<div class="form-group">
<label class="col-lg-2 control-label">描述</label>
               <div class="col-lg-10"> 
    <textarea name="description" type="text" class="form-control" style="height:60px;overflow:auto;"></textarea>
            </div>											</div>
            	<div class="form-group">
            	<div class="col-lg-10"> 
<input type="submit" class="btn btn-primary" name="" value="添加"  onclick="check_url()" /></div>
</div>
</div>					
</form>
</div>
</div>
</div>	
</div>
<script>
$(document).ready(function(){
selectAllToggle();
$("#adm_link_list tbody tr:odd").addClass("tralt_b");
$("#adm_link_list tbody tr").mouseover(function(){$(this).addClass("trover")}).mouseout(function(){$(this).removeClass("trover")})
});
function check_url(){  
    var elem = document.getElementById("#pic");  
    var input_value = elem.value;  
    input_value = input_value.toLowerCase();  
    var regExr = /^(http:|https:)\/\/.*$/m;  
    var result = regExr.test(input_value);  
    if (!result){  
        var new_value = "http://"+input_value;  
        elem.value=new_value;  
    }  
}  
function linkact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的链接');
		return;}
	if(act == 'del' && !confirm('你确定要删除所选链接吗？')){
	return;
	}
	$("#operate").val(act);
	$("#form_link").submit();
}
function changeLinkSort(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的链接');
		return;}
	if($('#linksort').val() == '')return;
	$("#operate").val('move');
	$("#form_link").submit();
}
$("#select_order").click(function(){
	$("#form_link").attr("action","link.php?action=link_taxis");
	$("#form_link").submit();
})
function selectSort(obj) {
    window.open("./link.php?linksortid=" + obj.value, "_self");
}
setTimeout(hideActived,2600);
$("#menu_link").addClass('active');
</script>