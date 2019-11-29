<?php
/*
Template Name:FLY
Description:<font color=red>＊</font>该主题为Finally原创主题<br><font color=red>＊</font>采用Bootstrap框架<br><font color=red>＊</font>响应式设计,全站Pjax<br><font color=red>＊</font>自带会员中心,功能更强大！<br><font color=red>＊</font>支持EMLOG6.0,支持PHP7+<br><a href="../?setting" target="_blank">设置</a>
Version:5.0
Author:Finally
Author Url:https://pjax.cn
Sidebar Amount:4
ForEmlog:6.0.1
Update_Version:VIP版
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
//设置时区
date_default_timezone_set('Asia/Shanghai');
//初始化
if(file_exists(EMLOG_ROOT.'/content/templates/FLY/install.php')){
	emDirect(TEMPLATE_URL."install.php");
	exit();
}
//载入函数
require_once View::getView('inc/functions');
//载入站点配置
require_once View::getView('inc/config');
$Tconfig = unserialize($Tconfig);
$GLOBALS['Tconfig'] = $Tconfig;
if($_GET['do'] == 'save'&& ROLE == ROLE_ADMIN){plugin_setting();}
//手机QQ打开跳转到浏览器
if($Tconfig['qqtz']== 1 ){
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
if (strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') !== !1 ) {
	echo '<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>请使用浏览器打开</title>
	<script src="https://open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
	<script type="text/javascript"> mqq.ui.openUrl({ target: 2,url: "' . $siteurl . '"}); </script>
	</head>
	<body></body>
	</html>';
 exit;
}}
//载入模块
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="generator" content="emlog" />
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="keywords" content="<?php echo $site_key; ?>">
	<meta name="description" content="<?php echo $site_description; ?>">
	<meta name="apple-mobile-web-app-title" content="<?php echo $blogname; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php if(isset($sortName)): ?>
    <link rel="canonical" href="<?php echo Url::sort($sortid);?>" />
    <?php elseif(isset($logid)):?>
    <link rel="canonical" href="<?php echo Url::log($logid);?>" />
    <?php else:?><?php endif;?>
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<link rel="shortcut icon" href="<?php echo BLOG_URL; ?>favicon.ico">
	<?php if(blog_tool_ishome()) :?>
	<title><?php echo $blogname; ?>-<?php echo $bloginfo; ?></title>
	<?php elseif(!empty($tws)):?>
	<title>微语 - <?php echo $blogname; ?></title>
	<?php else:?>
	<title><?php echo $site_title; ?></title> 
	<?php endif;?>
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/style.php?v=<?php echo Option::EMLOG_VERSION; ?>" type='text/css' media='screen' />
	<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
    <script src="<?php echo TEMPLATE_URL; ?>js/jquery.pjax.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>	
    <script src="<?php echo TEMPLATE_URL; ?>js/bootstrap.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/jquery.lazyload.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/tinymce/tinymce.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
	<?php doAction('index_head'); ?>
    <?php include View::getView('inc/skin');?>
</head>
<body class="nav-fixed">
<nav id="header" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="<?php echo BLOG_URL; ?>" class="navbar-brand logo"><img src="<?php echo TEMPLATE_URL."img/logo.png";?>" alt="<?php echo $site_title; ?>"></a>
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
	    </button>
		</div>
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav nav-top">
			<?php blog_navi();?>
			</ul>
			<div class="fly-nav-right">
				<div class="login-nav"><a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank"><i class="fa fa-user-circle"></i></a></div>
				<div class="logout-nav" style="display:none"><a href="<?php echo BLOG_URL; ?>?user&home"><span class="login-avatars"></span></a><div class="avatar-menu"><div class="dltips"><div class="dlli"><a href="<?php echo BLOG_URL; ?>?user&datas"><i class="fa fa-user-circle-o"></i> 修改资料</a></div><div class="dlli lgset"></div><div class="dlli logout"><a href="javascript:;" class="login_logout"><i class="fa fa-sign-out"></i> 退出登录</a></div></div></div></div>
				<div class="fly-search fly-search-s"><i class="fa fa-search"></i></div>
			</div>
		</div>

	</div>
  <style type="text/css"> #top-img {
    background: url(/1111.gif);
    height:4px;
    top:0px;
    position: fixed;
    width:100%;
    Z-index:9999;
} </style>
<div id="top-img"></div>
</nav>
<div id="<?php echo get_template_name();?>">