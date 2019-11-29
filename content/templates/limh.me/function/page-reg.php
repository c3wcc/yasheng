<?php
session_start();
if(ROLE == 'admin' || ROLE == 'writer'){
	header('Location:'.BLOG_URL.'admin/');
}
emLoadJQuery();
$username = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
$password2 = isset($_POST['password2']) ? addslashes(trim($_POST['password2'])) : '';
$imgcode = isset($_POST['imgcode']) ? strtoupper(addslashes(trim($_POST['imgcode']))): '';
if($username && $password && $password2 && $imgcode){
	$sessionCode = isset($_SESSION['code']) ? $_SESSION['code'] : '';
	if($imgcode == $sessionCode){
		$User_Model = new User_Model();
		if(!$User_Model -> isUserExist($username)){
			$hsPWD = new PasswordHash(8, true);
			$password = $hsPWD->HashPassword($password);
			$User_Model->addUser($username, $password, 'writer');
			echo'<script>alert("注册成功！"); window.location.href="'.BLOG_URL.'admin/"</script>';
		}else{
			echo'<script>alert("用户名已存在！");</script>';
		}
	}else{
		echo'<script>alert("验证码错误！");</script>';
	}
	
}
$log_content = '
<div class="box">
	<div class="inner">
		<form method="post" name="reg" id="reg" onsubmit="return checkReg();">
			<table>
			<tr>
				<td>用户名：</td><td><input name="username" type="text" required="required" placeholder="username" /></td>
			</tr>
			<tr>
				<td>密码：</td><td><input name="password" type="password" required="required" placeholder="password" /></td>
			</tr>
			<tr>
				<td>重复密码：</td><td><input name="password2" type="password" required="required" placeholder="password" /></td>
			</tr>
			<tr>
				<td>验证码：</td><td><input name="imgcode" type="text" class="yzinput" required="required" placeholder="verifycode" /><img src="'.BLOG_URL.'include/lib/checkcode.php" class="yzcode" /></td>
			</tr>
			<tr>
				<td align="right"></td><td><button type="submit">确认注册</button><button type="reset">重置</button></td><td></td>
			</tr>
			</table>
		</form>
	</div>
</div>';
echo $log_content;
?>