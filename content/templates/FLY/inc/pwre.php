<?php 
require dirname(__FILE__).'/../../../../init.php';

error_reporting(7);
$email = addslashes(trim($_POST['email']));
$CACHE->updateCache('options');
require_once(EMLOG_ROOT.'/include/lib/phpmailer.php');
require_once(EMLOG_ROOT.'/include/lib/smtp.php');
if (isEmailExist($email)!=true) {
	print_r(json_encode(array('error'=>0, 'status'=>'1')));
	exit;
}else{
	$row = getOneUser($email);
	$uid = $row['uid']; 
	$token = md5($uid.$row['username'].$row['password']);
	$url = BLOG_URL."?reset=reset&email=".$email."&token=".$token;
	$time = date('Y-m-d H:i');

    $from = $blogname;
    $headers = 'From: '.$from . "\r\n";  
    $subject = '密码找回-'.$blogname;  
    $msg = '您与'.$time.'提交了找回密码请求。请点击下面的链接重置密码<br/><a href='.$url.' target="_blank">'.$url.'</a>';
    if(sendmail_do(MAIL_SMTP,MAIL_PORT,MAIL_SENDEMAIL,MAIL_PASSWORD, $email,$subject, $msg, $blogname)){
        print_r(json_encode(array('error'=>0, 'msg'=>'系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时重置您的密码')));  
    }else{
        print_r(json_encode(array('error'=>1, 'msg'=>'密码邮件发送失败，请联系网站管理员'))); 
    }
}

function isEmailExist($email) {
	$db = Database::getInstance();
    $data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."user WHERE email='$email'");
    if ($data['total'] > 0) {
        return true;
    }else {
        return false;
    }
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
?>
