<?php
session_start();
!defined('EMLOG_ROOT') && exit('access deined!');
 
if(ROLE == 'admin' || ROLE == 'writer'){
	header('Location:'.BLOG_URL.'admin/');
}
global $CACHE;
$options_cache = $CACHE->readCache('options');
$DB = MySql::getInstance();
 
$username = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
$password2 = isset($_POST['password2']) ? addslashes(trim($_POST['password2'])) : '';
 
if($username && $password && $password2){
		$User_Model = new User_Model();
		if(!$User_Model -> isUserExist($username)){
			$hsPWD = new PasswordHash(8, true);
			$password = $hsPWD->HashPassword($password);
			$User_Model->addUser($username, $password, 'writer', 'y');
			$CACHE->updateCache();
			echo'<script>alert("注册成功！"); window.location.href="'.BLOG_URL.'admin/"</script>';
		}else{
			echo'<script>alert("用户名已存在！");</script>';
		}
}
?>
<script type="text/javascript">
function checkReg(){
	var usrName = $("input[name=username]").val().replace(/(^\s*)|(\s*$)/g, "");
	var pwd = $("input[name=password]").val().replace(/(^\s*)|(\s*$)/g, "");
	var pwd2 = $("input[name=password2]").val().replace(/(^\s*)|(\s*$)/g, "");

	if(usrName.match(/\s/) || pwd.match(/\s/)){
		alert("用户名和密码中不能有空格");
		return false;
	}
 
	if(usrName == '' || pwd == '' || yzm == ''){
		alert("用户名、密码、验证码都不能为空！");
		return false;
	}
	if(usrName.length < 3 || pwd.length < 5){
		alert("用户名不能少于3位和密码都不能小于5位！");
		return false;
	}
	else if(pwd != pwd2){
		alert("两次输入密码不相等！");
		return false;
	}
}
$(function(){
	$("#imginfo").click(function(){
		$("img#yzcode").attr("src", "<?php echo BLOG_URL;?>include/lib/checkcode.php?"+Math.random());
	});
});
</script>
<style>
/*登陆页面*/
.finally-box{width:600px; border:3px solid #f2f2f2; border-radius:10px; margin:30px auto;}
.finally-box .inner{border:1px solid #ccc; border-radius:10px; padding:10px 20px;}
.finally-box .inner .info{font-size:12px; color:#999;}
.finally-box .inner table{line-height:30px; margin:0 auto; border:none;}
.finally-box .inner table input{height:20px; width:185px; border-radius: 3px; border: 1px solid #ccc;}
.finally-box .inner table input.rbtn{background:#45BCF9; border:1px solid #45BCF9; height:25px; width:60px; cursor:pointer;border-radius: 3px;color:#fff}
.finally-box .inner table input.rbtn:hover{background:#66C7F9; border:1px solid #66C7F9;cursor:url(<?php echo TEMPLATE_URL;?>style/link.cur),pointer;}
.finally-box .inner .bot{font-size:12px;}
.finally-box .inner .bot a{color:#999;}
.finally-box .inner .bot a:hover{color:#333;}
.finally-box table td{border:none;text-align:left;color: #999;}
</style>
<div id="container">
	<div id="anitOut"></div>
	<div id="content" role="main">
		<div class="page">
			<article role="article">
				<header class="post-header"><h2><i class="fa fa fa-comments"></i> <?php echo $log_title; ?></h2></header>
				<address class="post-metaa">
					<i class="fa fa-home"></i><a href="<?php echo BLOG_URL; ?>" title="返回首页">首页</a> » <i class="fa fa-file-text-o"></i> <?php echo $log_title; ?> » <i class="fa fa-clock-o"></i> <?php mydate($date) ?>
				</address>
            ﻿
				<div class="post-context">
						<div class="finally-box">
			<div class="inner">
				<table align="center">
					<form action="" method="post" name="reg" id="reg" onsubmit="return checkReg();">
					<tr>
						<td align="right">用户名：</td><td><input name="username" class="usr" ></td><td> <span class="info">* 必填，勿填敏感词汇</span></td>
					</tr>
					<tr>
						<td align="right">密码：</td><td><input name="password" type="password"></td><td> <span class="info">* 必填，大于等于5位</span></td>
					</tr>
					<tr>
						<td align="right">重复密码：</td><td><input name="password2" type="password"></td><td> <span class="info">* 必填，重复上级信息</span></td>
					</tr>
					<tr>
						<td align="right"></td><td><input type="submit" value="注册" class="rbtn"> <input type="reset" value="重置" class="rbtn"> <input type="button" onclick="window.open('<?php echo BLOG_URL; ?>admin')" value="登录" class="rbtn"></td><td></td>
					</tr>
					</form>
				</table>
			</div>
		</div>
					<div class="clear"></div>
					<div class="cutline"></div>
				</div>
			</article>
			<div id="comments">
				<?php //blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
				<?php //blog_comments($comments,$params); ?>
			</div>
		</div>
	</div>
	<?php include View::getView('side');?>
</div>
<?php include View::getView('footer');?>