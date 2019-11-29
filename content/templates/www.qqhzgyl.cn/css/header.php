<?php
/*
Template Name:Meta模板{}
Description:<font color=red>＊</font>该主题为蓝优原创主题<br><font color=red>＊</font>采用HTML+CSS，全站自适应设计<br><font color=red>＊</font>无会员版本<br><a href="../?setting" target="_blank">设置</a>
Version:5.3
Author:蓝优
Author Url:http://lanyou.vip
Sidebar Amount:2
ForEmlog:5.3
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('inc/functions');
require_once View::getView('inc/config');
require_once View::getView('module');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="meta" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<link rel="icon" href="<?php echo TEMPLATE_URL; ?>favicon.ico">
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TEMPLATE_URL; ?>css/new.php"/>  
<!--js-->
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jPages.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.lazyload.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body>
<div class="wap">
	<!--顶部-->
	<div class="wap-top">
		<div id="nav-top">		
			<span class="top-left"><?php echo $bloginfo; ?></span>			
			<span class="top-right">
			<a href="http://www.qqhzgyl.cn/?plugin=tougao" target="_blank" title="在线投稿">在线投稿</a>
			<a href="<?php echo $hezuo; ?>" target="_blank" title="合作">合作</a>
			<a href="tencent://message/?uin=<?php echo $qqhm; ?>" rel="nofollow" target="_blank" title="联系">联系</a>
			</span>
		</div>
	</div>
	<!--LOGO与搜索-->
	<div class="divbox">
		<div class="container-box">
			<a href="<?php echo BLOG_URL;?>" class="logo" title="<?php echo $bloginfo; ?>"><img src="<?php echo $logo ?  $logo : ''.TEMPLATE_URL."images/logo.png";?>" alt="LOGO"></a>
			<a href="javascript:;" id="nav-toggle" class="mmenu-btn"><i class="fa fa-bars"></i></a>
			<a class="so-search" href="javascript:;"><i class="fa fa-search"></i></a>
			 <form method="get" action="<?php echo BLOG_URL;?>" class="search">
				<input type="text" placeholder="快来搜一搜吧！" value="" name="keyword">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>				    
	</div>
	<!--PC导航-->
	<div class="pc-nav">
	<?php blog_navi();?>
	</div>
	<!--menu导航-->
	<?php menu_navi();?>
	<!--首页_上部开始 -->
<div class="HtmlMoKua" style="text-align:center;">
<a href="http://www.81936505.top/" target="_blank"><img src="content/templates/meta/images/add.png" width="1178" height="70" alt="" /></a>
<a href="#" target="_blank"><img src="gg/1.jpg" width="1178" height="70" alt="" /></a>
<a href="http://tbk.ruoze.cc/index.php?r=nine&cid=6&u=663273" target="_blank"><img src="http://www.ruoze.cc/gg/13.png" width="1178" height="70" alt="" /></a></div>
<!--内容-->
	<div class="container">
		<div class="content">