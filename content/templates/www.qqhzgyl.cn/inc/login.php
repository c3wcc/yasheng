<?php
require_once '../../../../init.php';
$action=$_GET["action"];
$msg=array();
if ($action=="signin"){
	$username = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
	$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
	$code = isset($_POST['imgcode']) ? addslashes(trim(strtoupper($_POST['imgcode']))) : "";
	if (LoginAuth::checkUser($username, $password,$code)===true) {
		LoginAuth::setAuthCookie($username);
		//emDirect("./");
		//emMsg('登录成功!',BLOG_URL.'',true);
			$msg["msg"]=1;
			$msg["goto"]=BLOG_URL;
		}else{
			$msg["msg"]=0;
		}
		//echo json_decode($msg);
			if($msg["msg"] == 1){
		emMsg('登录成功!',BLOG_URL.'',true);
	}else{
		emMsg('登录失败，请检查用户名密码是否正确!',BLOG_URL.'',true);
		//emDirect("./blogger.php?active_edit=1");
	}
}
?>
