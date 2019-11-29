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
<li id="tab_user" class="cur">
<a href="link.php" class="waves-effect waves-light">用户管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-success">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_update'])):?><div class="alert alert-success">修改用户资料成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-success">添加用户成功</div><?php endif;?>
<?php if(isset($_GET['error_login'])):?><div class="alert alert-danger">用户名不能为空</div><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><div class="alert alert-danger">该用户名已存在</div><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><div class="alert alert-danger">密码长度不得小于6位</div><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><div class="alert alert-danger">两次输入密码不一致</div><?php endif;?>
<?php if(isset($_GET['error_del_a'])):?><div class="alert alert-danger">不能删除创始人</div><?php endif;?>
<?php if(isset($_GET['error_del_b'])):?><div class="alert alert-danger">不能修改创始人信息</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="links" class="tab-pane fade active in" role="tabpanel">
<form action="comment.php?action=admin_all_coms" method="post" name="form" id="form">
<div class="table-wrap ">		
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0" id="adm_user_list">
<thead>
      <tr>
        <th width="60px">头像</th>
        <th width="220px"><b>用户</b></th>
        <th width="250px" class="hided"><b>描述</b></th>
        <th width="240px" class="hided"><b>电子邮件</b></th>
		<th width="60px" class="tdcenter"><b>文章</b></th>
		<th width="130px"><b>操作</b></th>
      </tr>
      
    </thead>
    <tbody>
	<?php
	if($users):
	foreach($users as $key => $val):
		$avatar = empty($user_cache[$val['uid']]['avatar']) ? './views/app/img/avatar.jpg' : '../' . $user_cache[$val['uid']]['avatar'];
	?>
     <tr>
        <td style="padding:3px; text-align:center;"><img src="<?php echo $avatar; ?>" height="40" width="40" /></td>
		<td>
		<?php echo empty($val['name']) ? $val['login'] : $val['name']; ?><br />
		<?php echo $val['role'] == ROLE_ADMIN ? $val['uid'] == 1 ? '创始人':'管理员' : '作者'; ?>
        <?php if ($val['role'] == ROLE_WRITER && $val['ischeck'] == 'y') echo '(文章需审核)';?>
		</td>
		<td class="hided"><?php echo $val['description']; ?></td>
		<td class="hided"><?php echo $val['email']; ?></td>
		<td class="tdcenter"><a href="./admin_log.php?uid=<?php echo $val['uid'];?>"><?php echo $sta_cache[$val['uid']]['lognum']; ?></a></td>
     
     
     <td>	
     <?php 
        if (UID != $val['uid']): ?>
		<a href="user.php?action=edit&uid=<?php echo $val['uid']?>">编辑</a> 
		<a href="javascript: em_confirm(<?php echo $val['uid']; ?>, 'user', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
		<?php else:?>
		<a href="blogger.php">编辑</a>
		<?php endif;?></td>
		
		</tr>
	<?php endforeach;else:?>
	  <tr><td class="tdcenter" colspan="6">还没有添加作者</td></tr>
	<?php endif;?>
    </tbody>
  </table>
  </div>
  </div>
  <div class="list_footer">
<a href="#adduser" data-toggle="modal" class="btn btn-success">添加用户+</a>
  </div>
</form>
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduserLabel" aria-hidden="true">		
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title" id="adduserLabel">添加用户</h4>
</div>
<div class="modal-body">
<form action="user.php?action=new" method="post" class="form-horizontal" >
<div class="form-group">
<div class="col-lg-12"> 
<select name="role" id="role" class="form-control">
<option value="writer"> 作者（投稿人） </option>
<option value="admin"> 管理员 </option>
</select>
 </div>											
 </div>
 <div class="form-group">
<label class="col-lg-2 control-label">
用户名
</label>
<div class="col-lg-10"> 
<input name="login" type="text" id="login" value="" class="form-control" /> 
 </div>											
 </div>
 <div class="form-group">
<label class="col-lg-2 control-label">
网站
</label>
<div class="col-lg-10"> 
<input name="website" type="text" id="website" value="" class="form-control" /> 
 </div>											
 </div>
  <div class="form-group">
<label class="col-lg-2 control-label">
邮箱
</label>
<div class="col-lg-10"> 
<input name="email" type="text" id="email" value="" class="form-control" /> 
 </div>											
 </div>
<div class="form-group">
<label class="col-lg-2 control-label"> 密码 (大于6位) </label>
<div class="col-lg-10"> <input name="password" type="password" id="password" value="" class="form-control" />
</div>											
</div>
<div class="form-group">
<label class="col-lg-2 control-label"> 重复密码 </label>
<div class="col-lg-10"> <input name="password2" type="password" id="password2" value="" class="form-control" />
</div>											
</div>
<div class="form-group">
<div class="col-lg-12"  id="ischeck"> 
<select name="ischeck" class="form-control">
<option value="n"> 文章不需要审核 </option><option value="y"> 文章需要审核 </option>
</select>
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
<div class="form-group text-center">
<?php if(!empty($pageurl)){ ?>
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
<?php }?>
<div style="text-align:center">
(有<?php echo $usernum; ?>位用户)
</div>
</div>
<script>
$(document).ready(function(){
	$("#adm_user_list tbody tr:odd").addClass("tralt_b");
	$("#adm_user_list tbody tr")
		.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
		.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();})
    $("#role").change(function(){$("#ischeck").toggle()})
});
setTimeout(hideActived,2600);
$("#menu_user").addClass('active');
</script>
