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
<li id="tab_nav" class="cur">
<a href="navbar.php" class="waves-effect waves-light">系统导航</a>
</li>
</ul>
</div>

<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_taxis'])):?><div class="alert alert-success">排序更新成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?><div class="alert alert-success">删除导航成功</div><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-success">修改导航成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-success">添加导航成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">导航名称和地址不能为空</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger">没有可排序的导航</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger">默认导航不能删除</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger">请选择要添加的分类</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger">请选择要添加的页面</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger">导航地址格式错误(需包含http等前缀)</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="nav" class="tab-pane fade active in" role="tabpanel">
<form action="navbar.php?action=taxis" method="post">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0" id="adm_navi_list">
<thead>
      <tr>
        <th width="40px"><b>序号</b></th>
        <th width="230px"><b>导航</b></th>
        <th width="60px" class="tdcenter"><b>类型</b></th>
        <th width="60px" class="tdcenter"><b>状态</b></th>
        <th width="60px" class="tdcenter"><b>查看</b></th>
        <th width="360px" class="hided"><b>地址</b></th>
        <th width="100px">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if($navis):
    foreach($navis as $key=>$value):
        if ($value['pid'] != 0) {
            continue;
        }
        $value['type_name'] = '';
        switch ($value['type']) {
            case Navi_Model::navitype_home:
            case Navi_Model::navitype_t:
            case Navi_Model::navitype_admin:
                $value['type_name'] = '系统';
                break;
            case Navi_Model::navitype_sort:
                $value['type_name'] = '<font color="blue">分类</font>';
                break;
            case Navi_Model::navitype_page:
                $value['type_name'] = '<font color="#00A3A3">页面</font>';
                break;
            case Navi_Model::navitype_custom:
                $value['type_name'] = '<font color="#FF6633">自定</font>';
                break;
        }
        doAction('adm_navi_display');
    ?>  
      <tr>
        <td><input class="form-control em-small" name="navi[<?php echo $value['id']; ?>]" value="<?php echo $value['taxis']; ?>" maxlength="4" /></td>
        <td><a href="navbar.php?action=mod&amp;navid=<?php echo $value['id']; ?>" title="编辑导航"><?php echo $value['naviname']; ?></a></td>
        <td class="tdcenter"><?php echo $value['type_name'];?></td>
        <td class="tdcenter">
        <?php if ($value['hide'] == 'n'): ?>
        <a href="navbar.php?action=hide&amp;id=<?php echo $value['id']; ?>" title="点击隐藏导航">显示</a>
        <?php else: ?>
        <a href="navbar.php?action=show&amp;id=<?php echo $value['id']; ?>" title="点击显示导航" style="color:red;">隐藏</a>
        <?php endif;?>
        </td>
         <td class="tdcenter zmdi-lg">
         <?php  if($value['id'] == '1' || $value['id']=='2' || $value['id']=='3'):
         ?>
        <a href="../<?php echo $value['url']; ?>" target="_blank" title="查看">
        <?php else:?>
         <a href="<?php echo $value['url']; ?>" target="_blank" title="查看">
         <?php 
            endif;
            ?>
        <i class="zmdi zmdi-window-restore"></i> </a> </a>
        </td>
        <td class="hided"><?php echo $value['url']; ?></td>
        <td>
        <a href="navbar.php?action=mod&amp;navid=<?php echo $value['id']; ?>">编辑</a>
        <?php if($value['isdefault'] == 'n'):?>
        <a href="javascript: em_confirm(<?php echo $value['id']; ?>, 'navi', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
        <?php endif;?>
        </td>
      </tr>
    <?php
        if(!empty($value['childnavi'])):
        foreach ($value['childnavi'] as $val):
    ?>
        <tr>
        <td><input class="form-control em-small" name="navi[<?php echo $val['id']; ?>]" value="<?php echo $val['taxis']; ?>" maxlength="4" /></td>
        <td>---- <a href="navbar.php?action=mod&amp;navid=<?php echo $val['id']; ?>" title="编辑导航"><?php echo $val['naviname']; ?></a></td>
        <td class="tdcenter"><?php echo $value['type_name'];?></td>
        <td class="tdcenter">
        <?php if ($val['hide'] == 'n'): ?>
        <a href="navbar.php?action=hide&amp;id=<?php echo $val['id']; ?>" title="点击隐藏导航">显示</a>
        <?php else: ?>
        <a href="navbar.php?action=show&amp;id=<?php echo $val['id']; ?>" title="点击显示导航" style="color:red;">隐藏</a>
        <?php endif;?>
        </td>
 <td class="tdcenter zmdi-lg">
        <a href="<?php echo $value['url']; ?>" target="_blank" title="查看">
        <i class="zmdi zmdi-window-restore"></i> </a> </a>
        </td>
        <td class="hided"><?php echo $val['url']; ?></td>
        <td>
        <a href="navbar.php?action=mod&amp;navid=<?php echo $val['id']; ?>">编辑</a>
        <?php if($val['isdefault'] == 'n'):?>
        <a href="javascript: em_confirm(<?php echo $val['id']; ?>, 'navi', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
        <?php endif;?>
        </td>
      </tr>
      <?php endforeach;endif; ?>
    <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="4">还没有添加导航</td></tr>
    <?php endif;?>
    </tbody>
  </table>
  </div>
  </div>
  <div class="list_footer">
  <input type="submit" value="改变排序" class="btn btn-primary" />
   <a href="#add_nav" data-toggle="modal" class="inline-block btn btn-warning" />添加导航
</a>
  </div>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="add_nav" tabindex="-1" role="dialog" aria-labelledby="add_navLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="zmdi zmdi-close"></i> </button>
<h4 class="modal-title" id="add_navLabel">添加导航+</h4>
</div>
<div class="modal-body">	
<div class="panel panel-default panel-tabs">
<div class="panel-heading">
<ul role="tablist" class="nav nav-tabs">
<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="custom_tab" href="#custom"> 自定义 </a>
</li>
<li role="presentation" class=""><a data-toggle="tab" id="sort_tab" role="tab" href="#sort" aria-expanded="false"> 添加分类 </a></li>
<li role="presentation" class=""><a data-toggle="tab" id="page_tab" role="tab" href="#page" aria-expanded="false"> 添加页面 </a></li>
</ul>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="tab-content">		
<div id="custom" class="tab-pane fade active in" role="tabpanel">
<form action="navbar.php?action=add" method="post" name="navi" id="navi">
<div class="form-group">
<label>序号</label>
<input maxlength="4" class="em-small form-control"  name="taxis" />
</div>
<div class="form-group">
<label>名称</label>
<input maxlength="200" class="form-control" name="naviname" />
</div>
<div class="form-group">
<label> 地址(带http) </label>
<input maxlength="200" class="form-control" name="url" id="url" />
</div>
<div class="form-group form-inline">
<label>父导航
</label>
 <select name="pid" id="pid" class="form-control">
 <option value="0">无</option>
  <?php
  foreach($navis as $key=>$value):
    if($value['type'] != Navi_Model::navitype_custom || $value['pid'] != 0) {
        continue;
        }
   ?>
  <option value="<?php echo $value['id']; ?>"><?php echo $value['naviname']; ?></option>
   <?php endforeach; ?>
  </select>
</div>
 <div class="form-group"> 
<input type="checkbox" style="vertical-align:middle;" value="y" name="newtab" />
<label>新窗口打开</label>
</div>
<div class="form-group">	
<input type="submit" class="btn btn-primary" name="" value="添加"  />
</div>
 </form>
</div>
<div id="sort" class="tab-pane fade" role="tabpanel">
<form action="navbar.php?action=add_sort" method="post" name="navi" id="navi">			
	<?php 
	if($sorts):
    foreach($sorts as $key=>$value):
	if ($value['pid'] != 0) {
		continue;
	}
    ?>
<div class="form-group form-inline">
<input type="checkbox"  name="sort_ids[]" value="<?php echo $value['sid']; ?>" class="ids" />
<label ><?php echo $value['sortname']; ?></label >
	<?php
		$children = $value['children'];
		foreach ($children as $key):
		$value = $sorts[$key];
	?>
	</div>
<div class="form-group form-inline">
      <input type="checkbox" style="vertical-align:middle;" name="sort_ids[]" value="<?php echo $value['sid']; ?>" class="ids" />
<label ><?php echo $value['sortname']; ?></label >
<?php 
  endforeach;
   endforeach;
 ?>
</div>
<div class="form-group" style="padding-top:10px">
<input type="submit" name="" class="btn btn-info"  value="添加"  />
</div>
	<?php else:?>
<div class="form-group form-inline">
还没有分类,<a href="sort.php">添加分类</a>
</div>
	<?php endif;?> 
</form>
</div>
<div id="page" class="tab-pane fade" role="tabpanel">
<form action="navbar.php?action=add_page" method="post" name="navi" id="navi">			
	<?php 
	if($pages):
	foreach($pages as $key=>$value): 
	?>
<div class="form-group form-inline">
        <input type="checkbox" name="pages[<?php echo $value['gid']; ?>]" value="<?php echo $value['title']; ?>" class="ids" />
	<label ><?php echo $value['title']; ?></label>
</div>
	<?php endforeach;?>
	<div class="form-group" style="padding-top:10px">	
	<input type="submit" name="" class="btn btn-success"  value="添加"  />
	</div>
	<?php else:?>
	<div class="form-group form-inline"> 还未添加页面,<a href="page.php">添加页面</a></div>
	<?php endif;?> 
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    $("#adm_navi_list tbody tr:odd").addClass("tralt_b");
    $("#adm_navi_list tbody tr")
        .mouseover(function(){$(this).addClass("trover")})
        .mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived, 2600);
$("#menu_navi").addClass('active');
</script>
