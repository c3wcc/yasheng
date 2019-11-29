<?php
/**
 * 密码找回
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}

$token = stripslashes(trim($_GET['token'])); 
$email = stripslashes(trim($_GET['email']));
$password = isset($_POST['pass1']) ? addslashes(trim($_POST['pass1'])) : '';
$password2 = isset($_POST['pass2']) ? addslashes(trim($_POST['pass2'])) : '';
$row = getOneUser($email);
if($_POST){
	if(strlen($password) < 6 || strlen($password2) < 6){
		$info = '您输入的密码必须在6-16位';
	}else{
		if($password != $password2){
			$info = '您两次输入的密码不一致';
		}else{
			$User_Model = new User_Model();
			$PHPASS = new PasswordHash(8, true);
			$password = $PHPASS->HashPassword($password);
			$userData['password'] = $password;
			$User_Model->updateUser($userData, $row['uid']);
			$CACHE->updateCache('user');
			$info = '修改成功！';
		}
	}
}
if ($row) {
?>
<style>
.content-wrap .content.resetpass{padding: 20px;text-align: center;margin-right: 0;background-color: #fff;border: 1px solid #EAEAEA;border-radius: 4px;min-height:480px;}
.resetpass form{width: 300px;margin: 0 auto;text-align: left;}
.resetpass form p{margin-bottom: 20px;}
.resetpass h1{font-size: 24px;font-weight: normal;}
.resetpass h3{color: #777;}
.resetpass h3 .glyphicon{top: 4px;}
.resetpasssteps{margin-bottom: 50px;overflow: hidden;}
.resetpasssteps li{width: 33.33333%;float: left;background-color: #eee;color: #666;line-height: 33px;position: relative;}
.resetpasssteps li.active{background-color: #45B6F7;color: #fff;}
.resetpasssteps li .glyphicon{position: absolute;right: -17px;top:-10px;font-size: 46px;color: #fff;z-index: 2}
.errtip{background-color: #FCEAEA;color: #DB5353;padding: 8px 15px;font-size: 14px;border: 1px solid #FC9797;border-radius: 5px}
</style>
        <div class="container">
            <div class="content-wrap">
                <div id="content" class="content resetpass">
                    <h1 class="hide">重置密码</h1>
                    <ul class="resetpasssteps">
            			<li>获取密码重置邮件<span class="glyphicon glyphicon-chevron-right"></span></li>
            			<li class="active">设置新密码<span class="glyphicon glyphicon-chevron-right"></span></li>
            			<li>成功修改密码</li>
            		</ul>
            		<form action="" method="post">
					<?php 
					$mt = md5($row['uid'].$row['username'].$row['password']);
					if ($mt==$token) {?>
            		    <?php echo $info ? $info : '';?>
            			<h3>设置新密码：</h3>
            			<p><input type="password" name="pass1" class="form-control input-lg" placeholder="输入新密码" autofocus></p>
            			<h5>重复新密码：</h5>
            			<p><input type="password" name="pass2" class="form-control input-lg" placeholder="重复新密码"></p>
            			<p><input type="submit" value="确认提交" class="btn btn-block btn-primary btn-lg"></p>
					<?php }else{ ?>
            		    <h3>链接已失效，请重新发送找回邮件</h3>
					<?php }?>
            		</form> 
                </div>
            </div>
        </div> 

<?php
}
function getOneUser($email){
	$db = Database::getInstance();
    $row = $db->once_fetch_array("select * from ".DB_PREFIX."user where email='$email'");
    $userData = array();
    if($row) {
        $userData = array(
        	'uid' => htmlspecialchars($row['uid']),
            'username' => htmlspecialchars($row['username']),
            'password' => htmlspecialchars($row['password'])
        );
    }
    return $userData;
}

include View::getView('footer');?>