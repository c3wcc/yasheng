<?php
/*
Plugin Name: Sendmail
Version: 3.8
Plugin URL: http://kller.cn/?post=61
Description: 发送博客留言至E-mail。
Author: 作者：KLLER 美化：蓝叶
Author Email: kller@foxmail.com
Author URL: http://kller.cn

 * 教书先生对此进行美化：blog.oioweb.cn
*/

!defined('EMLOG_ROOT') && exit('access deined!');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.smtp.php');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.phpmailer.php');
function kl_sendmail_do($mailserver, $port, $mailuser, $mailpass, $mailto, $subject,  $content, $fromname)
{
	$mail = new KL_SENDMAIL_PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->Encoding = "base64";
	$mail->Port = $port;

	if(KL_MAIL_SENDTYPE == 1)
	{
		$mail->IsSMTP();
	}else{
		$mail->IsMail();
	}
	$mail->Host = $mailserver;
	$mail->SMTPAuth = true;
	$mail->Username = $mailuser;
	$mail->Password = $mailpass;

	$mail->From = $mailuser;
	$mail->FromName = $fromname;

	$mail->AddAddress($mailto);
	$mail->WordWrap = 500;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $content;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if($mail->Host == 'smtp.qq.com') $mail->SMTPSecure = "ssl";
	if(!$mail->Send())
	{
		echo $mail->ErrorInfo;
		return false;
	}else{
		return true;
	}
}
function kl_sendmail_get_comment_mail()
{
	include(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail_config.php');
	if(KL_IS_SEND_MAIL == 'Y' || KL_IS_REPLY_MAIL == 'Y')
	{
		$comname = isset($_POST['comname']) ? addslashes(trim($_POST['comname'])) : '';
		$comment = isset($_POST['comment']) ? addslashes(trim($_POST['comment'])) : '';
		$commail = isset($_POST['commail']) ? addslashes(trim($_POST['commail'])) : '';
		$comurl = isset($_POST['comurl']) ? addslashes(trim($_POST['comurl'])) : '';
		$gid = isset($_POST['gid']) ? intval($_POST['gid']) : (isset($_GET['gid']) ? intval($_GET['gid']) : -1);
		$pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
		$http_referer = empty($_SERVER['HTTP_REFERER']) ? BLOG_URL : $_SERVER['HTTP_REFERER'];

		$blogname = Option::get('blogname');
		$Log_Model = new Log_Model();
		$logData = $Log_Model->getOneLogForHome($gid);
		$log_title = $logData['log_title'];
		$subject = "[{$log_title}] 一文有新的评论";
  if(!empty($commail)){$commail = $commail;}else{$commail = '未填写';};
  if(!empty($comurl)){$comurl = $comurl;}else{$comurl = '未填写';};
		if(strpos(KL_MAIL_TOEMAIL, '@139.com') === false)
		{
			$content = '<style  type="text/css">.wrap span{display: inline-block;}
.w260{ width: 260px;}
.w20{ width: 20px;}
a:link{text-decoration:none}a:visited{text-decoration:none}a:hover{text-decoration:none}a:active{text-decoration:none}
.wauto{ width: auto;}</style>
<table style="width: 99.8%;height:99.8% "><tbody><tr><td style="background:#fafafa url(https://a.photo/images/2018/03/24/2017113018325846288465.png)"><div style="border-radius: 10px 10px 10px 10px;font-size:13px;    color: #555555;width: 666px;margin:50px auto;border:1px solid #eee;max-width:100%;background: #ffffff repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);">
        <div style="width:100%;background:#49BDAD;color:#ffffff;border-radius: 10px 10px 0 0;background-image: -moz-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));background-image: -webkit-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));height: 66px;">
            <p style="font-size:15px;word-break:break-all;padding: 23px 32px;margin:0;background-color: hsla(0,0%,100%,.4);border-radius: 10px 10px 0 0;">您的<a style="text-decoration:none;color: #ffffff;" href="'.BLOG_URL.'"> '.$blogname.' </a>上有新的评论啦！
            </p>
        </div>
        <div style="margin:40px auto;width:90%">
            <p>'.$comname.' 在您文章《'.$log_title.'》上发表评论:</p>
            <p style="background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);margin:20px 0px;padding:15px;border-radius:5px;font-size:14px;color:#555555;">'.$comment.'</p>
        
            <p class="wrap" style="text-decoration:none"><span class="w260">评论作者：'.$comname.'</span><span class="w20"> </span><span class="wauto">邮件地址：'.$commail.'</span></p>
            <p class="wrap" style="text-decoration:none"><span class="w260">网址地址：'.$comurl.'</span><span class="w20"> </span><span class="wauto">发送状态：通过！</span></p>
            
            <div class="btnn"><a style="text-decoration:none; color:#12addb"  href="'.Url::log($gid).'#'.$pid.'" target="_blank">[查看文章]</a>&nbsp;|&nbsp;<a style="text-decoration:none; color:#12addb"  href="'.BLOG_URL.'admin" target="_blank">[管理评论]</a></div>
        </div>
    </div>
</td></tr></tbody></table>';
		}else{
			$content = $comment;
		}
		if(KL_IS_SEND_MAIL == 'Y')
		{
			if(ROLE == 'visitor') kl_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, KL_MAIL_TOEMAIL, $subject, $content, $blogname);
		}
		if(KL_IS_REPLY_MAIL == 'Y')
		{
			if($pid > 0)
			{
				$DB = Option::EMLOG_VERSION >= '5.3.0' ? Database::getInstance() : MySql::getInstance();
				$Comment_Model = new Comment_Model();
				$pinfo = $Comment_Model->getOneComment($pid);
				if(!empty($pinfo['mail']))
				{
					$subject = "您在[{$blogname}]发表的评论收到了回复";
					$content = '<style  type="text/css">.wrap span{display: inline-block;}
.w260{ width: 260px;}
.w20{ width: 20px;}
a:link{text-decoration:none}a:visited{text-decoration:none}a:hover{text-decoration:none}a:active{text-decoration:none}
.wauto{ width: auto;}</style>
<table style="width: 99.8%;height:99.8% "><tbody><tr><td style="background:#fafafa url(https://a.photo/images/2018/03/24/2017113018325846288465.png)"><div style="border-radius: 10px 10px 10px 10px;font-size:13px;    color: #555555;width: 666px;margin:50px auto;border:1px solid #eee;max-width:100%;background: #ffffff repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);">
        <div style="width:100%;background:#49BDAD;color:#ffffff;border-radius: 10px 10px 0 0;background-image: -moz-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));background-image: -webkit-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));height: 66px;">
            <p style="font-size:15px;word-break:break-all;padding: 23px 32px;margin:0;background-color: hsla(0,0%,100%,.4);border-radius: 10px 10px 0 0;">您好，您之前在<a style="text-decoration:none;color: #ffffff;" href="'.Url::log($gid).'#'.$pid.'"> '.$log_title.' </a>发表的的评论：
            </p>
        </div>
        <div style="margin:40px auto;width:90%">
            <p>'.$comname.'给您的回复：</p>
            <p style="background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);margin:20px 0px;padding:15px;border-radius:5px;font-size:14px;color:#555555;">'.$comment.'</p>
        
            <p class="wrap" style="text-decoration:none"><span class="w260">评论作者：'.$comname.'</span><span class="w20"> </span><span class="wauto">邮件地址：'.$commail.'</span></p>
            <p class="wrap" style="text-decoration:none"><span class="w260">网址地址：'.$comurl.'</span><span class="w20"> </span><span class="wauto">发送状态：通过！</span></p>
            
            <div class="btnn"><a style="text-decoration:none; color:#12addb"  href="'.Url::log($gid).'#'.$pid.'" target="_blank">[查看文章]</a>&nbsp;|&nbsp;<a style="text-decoration:none; color:#12addb"  href="'.BLOG_URL.'" target="_blank">[进入博客]</a></div>
        </div>
    </div>
</td></tr></tbody></table>';
					kl_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, $pinfo['mail'], $subject, $content, $blogname);
				}
			}
		}
	}else{
		return;
	}
}
addAction('comment_saved', 'kl_sendmail_get_comment_mail');

function kl_sendmail_get_twitter_mail($r, $name, $date, $tid)
{
	include(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail_config.php');
	if(KL_IS_TWITTER_MAIL == 'Y')
	{
		$DB = Option::EMLOG_VERSION >= '5.3.0' ? Database::getInstance() : MySql::getInstance();
		$blogname = Option::get('blogname');
		$sql = "select a.content, b.username from ".DB_PREFIX."twitter a left join ".DB_PREFIX."user b on b.uid=a.author where a.id={$tid}";
		$res = $DB->query($sql);
		$row = $DB->fetch_array($res);
		$author = $row['username'];
		$twitter = $row['content'];
		$subject = "{$author}发布的碎语收到了新的回复";
		if(strpos(KL_MAIL_TOEMAIL, '@139.com') === false)
		{
			$content = "{$author}发布的碎语：{$twitter}<br /><br />{$name}对碎语的回复：{$r}<br /><br /><strong>=> 现在就前往<a href=\"{$_SERVER['HTTP_REFERER']}\" target=\"_blank\">碎语页面</a>进行查看</strong><br />";
		}else{
			$content = $r;
		}
		if(ROLE == 'visitor') kl_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, KL_MAIL_TOEMAIL, $subject, $content, $blogname);
	}
}
addAction('reply_twitter', 'kl_sendmail_get_twitter_mail');

function kl_sendmail_put_reply_mail($commentId, $reply)
{
	global $userData;
	include(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail_config.php');
	if(KL_IS_REPLY_MAIL == 'Y')
	{
		$DB = Option::EMLOG_VERSION >= '5.3.0' ? Database::getInstance() : MySql::getInstance();
		$blogname = Option::get('blogname');
		$Comment_Model = new Comment_Model();
		$commentArray = $Comment_Model->getOneComment($commentId);
		extract($commentArray);
		$subject="您在[{$blogname}]发表的评论收到了回复";
		if(strpos($mail, '@139.com') === false)
		{
			$emBlog = new Log_Model();
			$logData = $emBlog->getOneLogForHome($gid);
			$log_title = $logData['log_title'];
			$content =  '<style  type="text/css">.wrap span{display: inline-block;}
.w260{ width: 260px;}
.w20{ width: 20px;}
a:link{text-decoration:none}a:visited{text-decoration:none}a:hover{text-decoration:none}a:active{text-decoration:none}
.wauto{ width: auto;}</style>
<table style="width: 99.8%;height:99.8% "><tbody><tr><td style="background:#fafafa url(https://a.photo/images/2018/03/24/2017113018325846288465.png)"><div style="border-radius: 10px 10px 10px 10px;font-size:13px;    color: #555555;width: 666px;margin:50px auto;border:1px solid #eee;max-width:100%;background: #ffffff repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);">
        <div style="width:100%;background:#49BDAD;color:#ffffff;border-radius: 10px 10px 0 0;background-image: -moz-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));background-image: -webkit-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));height: 66px;">
            <p style="font-size:15px;word-break:break-all;padding: 23px 32px;margin:0;background-color: hsla(0,0%,100%,.4);border-radius: 10px 10px 0 0;">您好，您之前在<a style="text-decoration:none;color: #ffffff;" href="'.Url::log($gid).'#'.$pid.'"> '.$log_title.' </a>发表的的评论：
            </p>
        </div>
        <div style="margin:40px auto;width:90%">
            <p>'.$comname.'给您的回复：</p>
            <p style="background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);margin:20px 0px;padding:15px;border-radius:5px;font-size:14px;color:#555555;">'.$comment.'</p>
        
            <p class="wrap" style="text-decoration:none"><span class="w260">评论作者：'.$comname.'</span><span class="w20"> </span><span class="wauto">邮件地址：'.$commail.'</span></p>
            <p class="wrap" style="text-decoration:none"><span class="w260">网址地址：'.$comurl.'</span><span class="w20"> </span><span class="wauto">发送状态：通过！</span></p>
            
            <div class="btnn"><a style="text-decoration:none; color:#12addb"  href="'.Url::log($gid).'#'.$pid.'" target="_blank">[查看文章]</a>&nbsp;|&nbsp;<a style="text-decoration:none; color:#12addb"  href="'.BLOG_URL.'" target="_blank">[进入博客]</a></div>
        </div>
    </div>
</td></tr></tbody></table>';
		}else{
			$content = $reply;
		}
		if($mail != '')	kl_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, $mail, $subject, $content, $blogname);
	}else{
		return;
	}
}
addAction('comment_reply', 'kl_sendmail_put_reply_mail');

function kl_sendmail_menu()
{
	echo '<div class="sidebarsubmenu" id="kl_sendmail"><a href="./plugin.php?plugin=kl_sendmail">邮件设置</a></div>';
}
addAction('adm_sidebar_ext', 'kl_sendmail_menu');
?>