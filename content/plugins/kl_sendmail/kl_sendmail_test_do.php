<?php
/**
 * kl_sendmail_test_do.php
 * design by KLLER
 * 教书先生对此进行美化：blog.oioweb.cn
 */
require_once('../../../init.php');
!(ISLOGIN === true && $value['author'] == UID || ROLE == 'admin') && exit('access deined!');
include_once('kl_sendmail_config.php');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.smtp.php');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.phpmailer.php');
$blogname = Option::get('blogname');
$subject = $blogname.'测试邮件！';
$content = '<style  type="text/css">.wrap span{display: inline-block;}
.w260{ width: 260px;}
.w20{ width: 20px;}
a:link{text-decoration:none}a:visited{text-decoration:none}a:hover{text-decoration:none}a:active{text-decoration:none}
.wauto{ width: auto;}</style>
<table style="width: 99.8%;height:99.8% "><tbody><tr><td style="background:#fafafa url(https://a.photo/images/2018/03/24/2017113018325846288465.png)"><div style="border-radius: 10px 10px 10px 10px;font-size:13px;    color: #555555;width: 666px;margin:50px auto;border:1px solid #eee;max-width:100%;background: #ffffff repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);">
        <div style="width:100%;background:#49BDAD;color:#ffffff;border-radius: 10px 10px 0 0;background-image: -moz-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));background-image: -webkit-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));height: 66px;">
            <p style="font-size:15px;word-break:break-all;padding: 23px 32px;margin:0;background-color: hsla(0,0%,100%,.4);border-radius: 10px 10px 0 0;">您的<a style="text-decoration:none;color: #ffffff;" href="'.BLOG_URL.'"> '.$blogname.' </a>Sendmail 插件经测试结果：
            </p>
        </div>
        <div style="margin:40px auto;width:90%">
            <p>您的博客 '.$blogname.' Sendmail 插件经测试已经可以正常使用啦！ </p>
            <p style="background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);margin:20px 0px;padding:15px;border-radius:5px;font-size:14px;color:#555555;">这是一封测试邮件！</p>
        
            <p class="wrap" style="text-decoration:none"><span class="w260">评论作者：'.$comname.'</span><span class="w20"> </span><span class="wauto">邮件地址：'.$commail.'</span></p>
            <p class="wrap" style="text-decoration:none"><span class="w260">网址地址：'.$comurl.'</span><span class="w20"> </span><span class="wauto">发送状态：通过！</span></p>
            
            <div class="btnn"><a style="text-decoration:none; color:#12addb"  href="'.Url::log($gid).'#'.$pid.'" target="_blank">[查看文章]</a>&nbsp;|&nbsp;<a style="text-decoration:none; color:#12addb"  href="'.BLOG_URL.'" target="_blank">[管理评论]</a></div>
        </div>
    </div>
</td></tr></tbody></table>';
if(kl_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, KL_MAIL_TOEMAIL, $subject, $content, $blogname))
{
	echo '<font color="green">发送成功！请到相应邮箱查收！：）</font>';
}