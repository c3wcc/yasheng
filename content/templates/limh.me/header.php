<?php
/*
Template Name:Colorful七彩修改版
Description: Colorful七彩修复版2.7<br><br><font color=red>＊</font>如有问题，请Q我：972622982</font>
Version:2.6
Author:明月浩空&风宁
Author Url:http://blog.dzra.pw
Sidebar Amount:1
ForEmlog:5.3.1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="renderer" content="webkit" />
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="apple-touch-icon" href="<?php echo TEMPLATE_URL; ?>images/icon.png" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style.css?v=20170220-15"/>
<link rel="stylesheet" type="text/css" href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="//lib.baomitu.com/jquery/1.9.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"><\/script >');</script>
<?php if(_g('index_hdp')==1):?>
<script type="text/javascript" src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php endif;?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/prettify.js?v=20170205"></script>
<script type="text/javascript" src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js"></script>
<?php if (!isset($_COOKIE["commentposter"])) {setcookie('commentposter','匿名',time() + 31536000);}?>
<?php doAction('index_head'); ?>
<!--[if lt IE 9]> 
<script src="<?php echo TEMPLATE_URL; ?>js/html5.js"></script>
<style type="text/css">#wenkmPlayer{display:none}</style>
<![endif]-->
<?php if(_g('cnzz')==1):?>
<script>
var _czc = _czc || [];
_czc.push(["_setAccount", "<?php echo _g('cnzzid');?>"]);
</script>
<?php endif;?>
</head>
<body>
<header id="header1">
  <div class="open-nav"><i class="fa fa-list-ul"></i></div>
  <div class="logo1">
    <h1><a rel="index" title="网站首页" href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g('logo1'); ?>" alt="<?php echo $blogname; ?>" /></a></h1>
  </div>
</header>
<div id="lmhblog">
<header id="header">
  <div class="box">
    <div class="logo"> <a rel="index" title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><img src="<?php if(_g('logoqq')==1){
		echo myhk_qq(_g('qqhao'));}else{echo _g('logo');} ?>" alt="<?php echo $blogname; ?>" /></a> </div>
    <h1><a title="网站首页" href="<?php echo BLOG_URL; ?>"><?php echo $site_title; ?></a><?php if(_g('zbzy')==1):?><?php if (str_replace("?_pjax=%23lmhblog","",BLOG_URL . trim(Dispatcher::setPath(), '/')) == BLOG_URL): ?><div class="header-v" title="<?php echo _g('zbjs');?>"></div><?php endif;?><?php endif;?></h1>
    <div class="text">
	<ul>
	<?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');?><?php foreach($newtws_cache as $value): ?>
    <li><a title="查看更多微言碎语" href="<?php echo BLOG_URL . 't/'; ?>"><i class="fa fa-twitter"></i> <?php echo date('Y年n月j日 - ',$value['date']);echo preg_replace('/\[F(([1-4]?[0-9])|50)\]/','',$value['t']);?></li></a>
	<?php endforeach; ?>
</ul>
    </div>
  </div>
</header>
<div id="head-nav">
  <div class="head-nav-wrap clearfix" id="nav">
    <ul id="menu-index" class="nav">
      <?php blog_navi();?>
    </ul>
	<?php if(_g('dhkg')==1):?>
    <ul class="m-nav" >
      <?php if(_g('wbkg')==1):?>
	  <li><a rel="nofollow" title="新浪微博：@<?php echo _g('weiboid');?> [点击访问]" href="<?php echo _g('weibodz');?>" target="_blank"><i class="fa fa-weibo"></i> 微博</a></li>
	  <?php endif;?>
	  <?php if(_g('qqkg')==1): ?>
      <li> <a rel="nofollow" title="QQ：<?php echo _g('qqhao');?> [点击临时会话]" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('qqhao');?>&site=qq&menu=yes" target="_blank"><i class="fa fa-qq"></i> QQ</a></li>
	  <?php endif;?>
	  <?php if(_g('wxkg')==1): ?>
      <li><a class="wechat" rel="nofollow" title="点击查看微信二维码" href="<?php echo _g('weixin');?>" target="_blank"><i class="fa fa-wechat"></i> 微信</a></li>
	  <?php endif;?>
	  <?php if(_g('dykg')==1): ?>
      <li class="m-sch"> <a class="rss" rel="nofollow" title="RSS订阅" href="<?php echo BLOG_URL; ?>rss.php" target="_blank"><i class="fa fa-rss"></i> 订阅</a> </li>
	  <?php endif;?>
	  <?php if(_g('bjkg')==1): ?>
	  <li><a id="showbox" title="设置网站背景图片"><i class="fa fa-cogs"></i> 背景</a></li>
	  <?php endif;?>
    </ul>
	<?php endif;?>
  </div>
</div>
<?php if(_g('dhkg')==1):?>
<?php if(_g('bjkg')==1): ?>
<div id="bg-images_tanchu">
   <div id="changebg" class="changebg">
    <div class="tiphead"><i class="fa fa-cogs"></i> 设置背景图片<a id="kaiguan" href="javascript:;" title="关闭"></a></div>
    <div class="tipbody">
	<ul id="imgul">
	<li onclick="javascript:loadbg(1);"><?php if($_COOKIE['myhk_bg']=='1'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(2);"><?php if($_COOKIE['myhk_bg']=='2'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(3);"><?php if($_COOKIE['myhk_bg']=='3'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(4);"><?php if($_COOKIE['myhk_bg']=='4'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(5);"><?php if($_COOKIE['myhk_bg']=='5'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(6);"><?php if($_COOKIE['myhk_bg']=='6'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(7);"><?php if($_COOKIE['myhk_bg']=='7'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(8);"><?php if($_COOKIE['myhk_bg']=='8'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(9);"><?php if($_COOKIE['myhk_bg']=='9'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
	<li onclick="javascript:loadbg(10);"><?php if($_COOKIE['myhk_bg']=='10'):?><i class="fa fa-check-circle fa-2x checkit"></i><?php endif;?><i></i></li>
    </ul>
	</div>
   </div>
</div>
<?php endif;?>
<?php endif;?>
<div id="wrapper">
<div id="container">
<div id="anitOut"></div>