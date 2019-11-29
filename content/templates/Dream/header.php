<?php
/*
Template Name:Dream
Description:<span style="color:red">欢迎进行py交易</span>>><a href="http://blog.9wl.me">1梦博客</a></br>模板设置：>><a href="../?setting">设置</a>
Version:5.0
Author:1梦
Author Url:http://cnm1.cn/
Sidebar Amount:2
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
define("THEME_VER","5.0");
ini_set('date.timezone','Asia/Shanghai');
require_once View::getView('config');
require_once View::getView('module');
require_once View::getView('function');

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-title" content="emlog1梦">
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="1梦" />
<title><?php echo $site_title; ?></title>
<script data-no-instant src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.4.0/css/mdui.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/highlight.js/9.8.0/styles/monokai-sublime.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/simple-line-icons/2.4.1/css/simple-line-icons.css">
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>main.css">
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body gtools_scp_screen_capture_injected="true" class="mdui-loaded">
    
<script>
document.addEventListener('visibilitychange',function(){
if(document.visibilityState=='hidden') {
normal_title=document.title;
document.title='你不喜欢我了吗';
}
else
document.title=normal_title;
});
</script>

<div id="catui-header">
<div class="header">
<div class="header-canopy">
<div class="header-canopy-cover" style="background-image: url(<?php echo $logo_url; ?>);"></div>
<div class="header-canopy-cover-bk"></div>
<div class="header-canopy-menu">
<div class="catui-container">
<div class="header-canopy-menu-title"><?php echo $home_toptext;?></div>
<div class="header-canopy-menu-description"><?php echo $heightkey; ?></div>
<div class="header-canopy-menu-avatar">
<a href="<?php echo BLOG_URL; ?>"><img src="<?php echo $new_log_num; ?>"></a>
</div>
<div class="header-canopy-menu-content" id="menu-nav">
<div class="header-canopy-menu-btn mdui-ripple icon icon-menu" onclick="get_menu_nav_open('menu-nav');"></div>
<div class="header-canopy-menu-nav">
<?php blog_navi();?>
</div>
</div>
</div>
</div>
</div>
</div> 
    <button class="mdui-fab mdui-fab-hide mdui-ripple mdui-fab-fixed" onclick="get_to_top();"><i class="mdui-icon material-icons"></i></button>
</div>	
<div id="top-img"></div>
