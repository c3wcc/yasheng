<?php
/*
Template Name:fee
Description:<font color=red>＊</font>该主题为会飞的鱼原创主题<br><font color=red>＊</font>优化js,css,html死代码<br><font color=red>＊</font>极速浏览体验，友好观赏<br><a href="../?setting" target="_blank">设置</a>
Version:1.8
Author:会飞的鱼
Author Url:https://f162.cn
Sidebar Amount:4
ForEmlog:6.0.1
Update_Version:free
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
//设置时区
date_default_timezone_set('Asia/Shanghai');

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
	<body>卧槽，手机打开？</body>
	</html>';
 exit;
}}
//载入模块
require_once View::getView('module');
?>
<!DOCTYPE HTML>
<html>
<head><script src="https://xiongzhang.baidu.com/sdk/c.js?appid=1608241218019247"></script>
<meta charset="UTF-8">
<link rel="dns-prefetch" href="<?php echo BLOG_URL; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Cache-Control" content="no-siteapp">
<?php if(blog_tool_ishome()) :?>
<title><?php echo $blogname; ?>-<?php echo $bloginfo; ?></title>
<?php elseif(!empty($tws)):?>
<title>微语 - <?php echo $blogname; ?></title>
<?php elseif(!empty($keyword)):?>
<title>搜索关键词为 <?php echo $keyword; ?> 的文章共有 <?php echo $lognum; ?>条 - <?php echo $blogname; ?></title>
<?php else:?>
<title><?php echo $site_title; ?></title> 
<?php endif;?>
<link rel='stylesheet' id='animate-css' href='<?php echo TEMPLATE_URL; ?>static/css/wow.css?ver=<?php echo Option::EMLOG_VERSION; ?>' type='text/css' media='all'/>
<link rel='stylesheet' id='_bootstrap-css' href='<?php echo TEMPLATE_URL; ?>static/css/bootstrap.min.css?ver=<?php echo Option::EMLOG_VERSION; ?>' type='text/css' media='all'/>
<link rel='stylesheet' id='_fontawesome-css' href='<?php echo TEMPLATE_URL; ?>static/css/font-awesome.min.css?ver=<?php echo Option::EMLOG_VERSION; ?>' type='text/css' media='all'/>
<link rel='stylesheet' id='_main-css' href='<?php echo TEMPLATE_URL; ?>static/css/main.css?ver=<?php echo Option::EMLOG_VERSION; ?>' type='text/css' media='all'/>
<script src="<?php echo TEMPLATE_URL; ?>static/js/jquery.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>static/js/jquery.pjax.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>	
<script src="<?php echo TEMPLATE_URL; ?>static/js/tinymce/tinymce.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php if($logid && $type=='blog' ){?>
<link rel='stylesheet' id='wppay-css'  href='<?php echo TEMPLATE_URL; ?>static/css/wppay.css?v=<?php echo Option::EMLOG_VERSION; ?>' type='text/css' media='all' />
<?php }?>
<meta name="keywords" content="<?php echo $site_key; ?>">
<meta name="description" content="<?php echo $site_description; ?>">
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>static/img/favicon.ico">

<?php if($logid && $type=='page'): ?>
<link rel="canonical" href="<?php echo Url::sort($sortid);?>" />
<?php elseif($logid && $type=='blog'):?>
<link rel="canonical" href="<?php echo Url::log($logid);?>" />
<?php else:?><?php endif;?>
<!--[if lt IE 9]>
<script src="<?php echo TEMPLATE_URL; ?>staticjs/libs/html5.min.js"></script>
<![endif]-->
<?php doAction('index_head'); ?>
<?php include View::getView('inc/skin');?>
</head>
<body class="<?php if($logid && $type=='blog' ){?>post-template-default single single-post single-format-standard site-layout-2<?php }elseif($keyword || $tag || $author_name){?>search search-results logged-in site-layout-2<?php }elseif($logid && $type=='page'){?>home blog site-layout-2<?php }else{?>category category-activity site-layout-2<?php }?>">
<header class="header"><section class="container">
<?php if($Tconfig["logo"]== 1 ){?>
<h1 class="logo"><a title="<?php echo $blogname; ?>-<?php echo $bloginfo; ?>" href="<?php echo BLOG_URL; ?>"><i class="fa fa-logo"></i></a></h1>
<?php }else{ ?>
<h1 class="logo"><a title="<?php echo $blogname; ?>-<?php echo $bloginfo; ?>" href="<?php echo BLOG_URL; ?>"><img src="<?php echo TEMPLATE_URL."static/img/logo.png";?>" alt="<?php echo $site_title; ?>"></a></h1>
<?php }?>
<?php if(!islogin()){ ?>
<div class="wel">
	<div class="wel-item">
		<a href="javascript:;" class="user-login" data-sign="0">登录</a>
	</div>
	<div class="wel-item wel-item-btn">
		<a href="javascript:;" class="user-reg" data-sign="1">我要注册</a>
	</div>
</div>
<?php }else{ ?>
<div class="wel">
	<div class="wel-item">
		<a href="<?php echo BLOG_URL; ?>?user&home">会员中心</a>
	</div>
	<div class="wel-item has-sub-menu">
		<a href="<?php echo BLOG_URL; ?>?user&home">
		<img alt="" src="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" srcset="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-50 photo" height="50" width="50">
		<span class="wel-name"><?php global $userData;?><?php if(empty($userData["nickname"])){echo $userData["username"];}else{echo $userData["nickname"];}?></span>
		</a>
		<div class="sub-menu">
			<ul>
				<li><a href="<?php echo BLOG_URL; ?>?user&datas">修改资料</a></li>	
				<?php if(ROLE == 'admin'){ ?>
				<li><a href="<?php echo BLOG_URL; ?>admin" target="_blank">后台管理</a></li>
				<li><a href="<?php echo BLOG_URL; ?>?setting">模板设置</a></li>
				<?php }?>		
				<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			</ul>
		</div>
	</div>
</div>
<?php }?>
<div class="site-navbar">
	<ul>
		<?php blog_navi();?>
	</ul>
</div>
<?php if(!islogin()){ ?>
<div class="m-wel-start">
	<a href="javascript:;" class="user-login" data-sign="0"><i class="fa fa-login"></i></a>
</div>
<?php }else{ ?>
<div class="m-wel-start">
	<a class="m-user" href="javascript:;"><i class="fa fa-user"></i></a>
</div>
<div class="m-wel">
	<header>
	<img alt="" src="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" srcset="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-50 photo" height="50" width="50">
	<h4><?php global $userData;?><?php if(empty($userData["nickname"])){echo $userData["username"];}else{echo $userData["nickname"];}?></h4>
	<h5><?php if(empty($userData["email"])){echo $userData["username"];}else{echo $userData["email"];}?></h5>
	</header>
	<div class="m-wel-content">
		<ul>
          	<li><a href="<?php echo BLOG_URL; ?>?user&home">用户中心</a></li>
            <li><a href="<?php echo BLOG_URL; ?>?user&log">发布文章</a></li>
			<li><a href="<?php echo BLOG_URL; ?>?user&datas">修改资料</a></li>
            <li><a href="<?php echo BLOG_URL; ?>?user&comments">我的评论</a></li>
            <li><a href="<?php echo BLOG_URL; ?>?user&posts">我的文章</a></li>
			<?php if(ROLE == 'admin'){ ?>
				<li><a href="<?php echo BLOG_URL; ?>admin" target="_blank">后台管理</a></li>
				<li><a href="<?php echo BLOG_URL; ?>?setting">模板设置</a></li>
			<?php }?>

		</ul>
	</div>
	<footer>
	<a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出当前账户</a>
	</footer>
</div>
<?php }?>
<div class="m-navbar-start">
	<i class="fa fa-bars m-icon-nav"></i>
</div>
<div class="search-i">
	<a href="javascript:;" class="search-show active"><i class="fa fa-search"></i></a>
</div>
<div class="site-search">
	<div class="sb-search">
		<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
			<input id="key" class="sb-search-input" placeholder="输入关键字 Enter键搜索..." type="text" name="keyword" type="text" value="">
		</form>
	</div>
</div>
</section></header>
<style type="text/css">
.header {
    background-color: #ffffff;
    border-bottom: 1px solid #EAEAEA;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    border-color: rgba(0,0,0,.08);
}</style>

  <style type="text/css"> #top-img {
    background: url(https://ae01.alicdn.com/kf/H640f6d67443943c681b69169525baf49B.gif);
    height:4px;
    top:0px;
    position: fixed;
    width:100%;
    Z-index:9999;
} </style>
<div id="top-img"></div>