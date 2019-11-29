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
<a href="user.php" class="waves-effect waves-light"> 编辑用户 </a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['error_login'])):?><div class="alert alert-danger">用户名不能为空</div><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><div class="alert alert-danger">该用户名已存在</div><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><div class="alert alert-danger">密码长度不得小于6位</div><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><div class="alert alert-danger">两次输入密码不一致</div><?php endif;?>
</div>
</div>
 <span id="alias_msg_hook"></span>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑用户
        </div>
<div class="panel-body">
<form action="user.php?action=update" method="post">
<div class="form-group">
 <label>用户名</label>
<input type="text" value="<?php echo $username; ?>" name="username" class="form-control" />
</div>
<div class="form-group">
 <label> 昵称 </label>
<input type="text" value="<?php echo $nickname; ?>" name="nickname" class="form-control" />
</div>
<div class="form-group">
 <label> 新密码(不修改请留空) </label>
<input type="password" value="" name="password" class="form-control" />
</div>
<div class="form-group">
 <label> 重复新密码 </label>
<input type="password" value="" name="password2" class="form-control" />
</div>
<div class="form-group">
 <label> 电子邮件 </label>
<input type="text"  value="<?php echo $email; ?>" name="email" class="form-control" />
</div>
 <div class="form-group">
<label>
网站
</label>
<input name="website" type="text" id="website" value="<?php echo $website; ?>" class="form-control" /> 
 </div>					
<div class="form-group">
	<select name="role" id="role" class="form-control">
		<option value="writer" <?php echo $ex1; ?>>作者</option>
		<option value="admin" <?php echo $ex2; ?>>管理员</option>
	</select>
	</div>
    <div id="ischeck">
	<select name="ischeck" class="form-control">
        <option value="n" <?php echo $ex3; ?>>文章不需要审核</option>
		<option value="y" <?php echo $ex4; ?>>文章需要审核</option>
	</select>
	</div>
	<br />
	<div class="form-group">
	<label>个人描述</label>
	<textarea name="description" rows="5" class="form-control"><?php echo $description; ?></textarea></li>
	</div>
	<div class="form-group">
    <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
	<input type="hidden" value="<?php echo $uid; ?>" name="uid" />
	<input type="submit" value="保 存" class="btn btn-primary" />
	<input type="button" value="取 消" class="btn btn-default" onclick="window.location='user.php';" /></div>
</div>
</form>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
$("#menu_user").addClass('active');
if($("#role").val() == 'admin') $("#ischeck").hide();
$("#role").change(function(){$("#ischeck").toggle()})
</script>
