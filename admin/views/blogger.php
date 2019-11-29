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
<li id="tab_blogger" class="cur">
<a href="blogger.php" class="waves-effect waves-light">个人资料</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
    <?php if(isset($_GET['active_edit'])):?><div class="alert alert-success">个人资料修改成功</div><?php endif;?>
    <?php if(isset($_GET['active_del'])):?><div class="alert alert-success">头像删除成功</div><?php endif;?>
    <?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">昵称不能太长</div><?php endif;?>
    <?php if(isset($_GET['error_b'])):?><div class="alert alert-danger">电子邮件格式错误</div><?php endif;?>
    <?php if(isset($_GET['error_c'])):?><div class="alert alert-danger">密码长度不得小于6位</div><?php endif;?>
    <?php if(isset($_GET['error_d'])):?><div class="alert alert-danger">两次输入的密码不一致</div><?php endif;?>
    <?php if(isset($_GET['error_e'])):?><div class="alert alert-danger">该登录名已存在</div><?php endif;?>
    <?php if(isset($_GET['error_f'])):?><div class="alert alert-danger">该昵称已存在</div><?php endif;?>
    </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-account-box-o"></i> 个人设置
        </div>
<div class="panel-body">
<form action="blogger.php?action=update" method="post" name="blooger" id="blooger" enctype="multipart/form-data">
<div class="form-group">
    <div class="form-group text-center"> 
<?php echo $icon; ?> <input type="hidden" name="photo" value="<?php echo $photo; ?>" />
</div>
    <div class="form-group text-center">
    <label>头像(支持JPG、PNG格式图片)</label>
    <input name="photo" type="file" class="form-control" />
    </div>
    <div class="form-group">
<label class="control-label mb-10">昵称</label>
<input maxlength="50"  class="form-control" value="<?php echo $nickname; ?>" type="text" name="name" />
</div>	
<div class="form-group">
<label class="control-label mb-10">邮箱</label>
<input name="email" type="email" class="form-control" value="<?php echo $email; ?>"  maxlength="200" />
</div>	
 <div class="form-group">
<label class="control-label mb-10">
网站
</label>
<input name="website" type="url" id="website" value="<?php echo $website ?>" class="form-control" /> 
 </div>											
<div class="form-group">
<label class="control-label mb-10">描述</label>
<textarea name="description" class="form-control textarea"  type="text" maxlength="500"><?php echo $description; ?></textarea>
</div>	
<div class="form-group">
<label class="control-label mb-10">登录名</label>
<input maxlength="200"  type="text" class="form-control" value="<?php echo $username; ?>" name="username" />
</div>		
<div class="form-group">
<label class="control-label mb-10"> 新密码（不小于6位，不修改请留空） </label>
<input type="password" maxlength="200" class="form-control" value="" name="newpass" /> 
</div>	
<div class="form-group">
<label class="control-label mb-10"> 再输入一次新密码 </label>
<input type="password" maxlength="200" class="form-control"  value="" name="repeatpass" /> 
</div>	
<div class="clearfix">
</div>
<div class="form-group">	
 <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
 <input type="submit" value="保存资料" class="btn btn-success btn-round" onclick="check_url()" />
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$("#chpwd").css('display', $.cookie('em_chpwd') ? $.cookie('em_chpwd') : 'none');
setTimeout(hideActived, 2600);
$("#menu_user").addClass('active');
</script>
