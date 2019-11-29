<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title>404</title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="apple-touch-icon" href="<?php echo TEMPLATE_URL; ?>images/icon.png" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style.css?v=20170205-12"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>font-awesome.min.css?v=4.5.0">
<script type="text/javascript" src="//lib.baomitu.com/jquery/3.1.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"><\/script >');</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js?v=20150225"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/prettify.js?v=20170205"></script>
<script type="text/javascript" src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js"></script>
<?php doAction('index_head'); ?>
<!--[if lt IE 9]> 
<script src="<?php echo TEMPLATE_URL; ?>js/html5.js"></script>
<style type="text/css">#wenkmPlayer{display:none}</style>
<![endif]-->
</head>
<body>
<header id="header1">
  <div class="open-nav"><i class="fa fa-list-ul"></i></div>
  <div class="logo1">
    <h1><a rel="index" title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><img src="<?php echo TEMPLATE_URL; ?>images/logo.png" alt="<?php echo $blogname; ?>" /></a></h1>
  </div>
  <div id="container1">
    <div id="anitOut"></div>
  </div>
</header>
<div id="lmhblog">
<header id="header">
  <div class="box">
    <div class="logo"> <a rel="index" title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g('logo'); ?>" alt="<?php echo $blogname; ?>" /></a> </div>
    <h1><a title="网站首页" href="<?php echo BLOG_URL; ?>">404</a></h1>
    <div class="text">
      <ul>
        <?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');?>
        <?php foreach($newtws_cache as $value): ?>
        <li><a title="查看更多微言碎语" href="<?php echo BLOG_URL . 't'; ?>"><?php echo date('Y年n月j日 - ',$value['date']);echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'',$value['t']);?></li>
        </a>
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
      <ul class="m-nav" >
        <li><a rel="nofollow" title="新浪微博：@<?php echo _g('weiboid');?> [点击访问]" href="<?php echo _g('weibodz');?>" target="_blank"><i class="fa fa-weibo"></i> 微博</a></li>
        <li> <a rel="nofollow" title="QQ：<?php echo _g('qqhao');?> [点击临时会话]" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('qqhao');?>&site=qq&menu=yes" target="_blank"><i class="fa fa-qq"></i> QQ</a></li>
        <li><a class="wechat" rel="nofollow" title="点击查看微信二维码" href="<?php echo _g('weixindz');?>"><i class="fa fa-wechat"></i> 微信</a></li>
        <li class="m-sch"> <a class="rss" rel="nofollow" title="RSS订阅" href="<?php echo BLOG_URL; ?>rss.php" target="_blank"><i class="fa fa-rss"></i> 订阅</a> </li>
      </ul>
    </div>
  </div>
  <div id="wrapper">
    <div id="container">
      <div id="anitOut"></div>
      <div class="page">
        <header>
          <h2 class="post-name"><i class="fa fa-minus-circle"></i> 404</h2>
        </header>
        <address class="entry-meta">
        <i class="fa fa-home"></i><a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <i class="fa fa-file-text-o"></i>404 &raquo; <i class="fa fa-clock-o"></i>1944年4月4日 下午 04:44
        </address>
        <div id="errorBox">
          <h1><span>请允许我做一个悲伤的表情</span><img src="<?php echo TEMPLATE_URL; ?>images/404.gif" alt="请允悲" width="288" height="160" style="display:block"/></h1>
          <div id="errorSummary">
            <p>您访问的页面不小心被系统酱玩(bù)丢(cún)了(zài)！<br />
              The requested URL was not found on the server.</p>
            <p>如果您是手动输入，请检查您的输入是否正确，然后再F5一次！<br />
              If you entered the URL manually please check your spelling and try again.</p>
          </div>
          <div id="errorDetails"><strong>错误 404</strong> (url::<?php echo strtoupper(wcs_error_currentPageURL()); ?>)：就是找不到鸟你来咬我啊</div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="blackground"></div>
    <div title="返回顶部(或任意位置双击左键)" class="backtop"></div>
    <nav id="mmenu" role="navigation">
      <ul>
        <li>
          <div class="msearch">
            <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
              <input type="text" name="keyword" placeholder="搜搜更健康" />
              <input type="submit" name="submit" value="搜索" />
            </form>
          </div>
        </li>
        <?php blog_navi();?>
      </ul>
    </nav>
  </div>
  <footer id="footer" role="contentinfo">
    <address>
    <i class="fa fa-html5"></i> Copyright&nbsp;©&nbsp;2012-<?php echo date('Y',time())?>&nbsp;<?php echo $blogname; ?>
    <div class="copyright">&nbsp;|&nbsp;<?php echo $footer_info; ?>
      <?php doAction('index_footer'); ?>
      自豪的采用 <a href="http://www.emlog.net" title="Emlog <?php echo Option::EMLOG_VERSION;?>" target="_blank">Emlog <?php echo Option::EMLOG_VERSION;?></a>&nbsp;驱动&nbsp;|&nbsp;主题：Colorful[Pjax专版] </div>
    </address>
  </footer>

<?php empty($_COOKIE['myhk_bg']) ? $bgimgsrc = TEMPLATE_URL . 'images/bg/' . rand(2, 2) . '.jpg?v=new' : $bgimgsrc = TEMPLATE_URL . 'images/bg/' . $_COOKIE["myhk_bg"] . '.jpg' ;?>
<img class="bg-image" src="<?php echo $bgimgsrc; ?>" /><div class="bg-image-pattern"></div>
<script>blog="本页出现十万只草泥马！";</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global.js?v=20150912"></script>
</body>
</html>