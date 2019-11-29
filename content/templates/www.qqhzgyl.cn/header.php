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
	<!--内容-->
	<div class="container">
		<div class="content">
		<!--navbar end-->    <!--首页图片广告位 开始-->
<div class="bk8"></div>
<div class="xiaogao">
 <a rel="external nofollow" href="http://www.qqhzgyl.cn/" target="_blank"><img src="https://wx2.sinaimg.cn/large/e3afbb56gy1g0aj7vga31j20rs01ymxh.jpg" style="width: 100%;"></a>	<a rel="external nofollow" href="http://www.qqhzgyl.cn/" target="_blank"><img src="https://wx3.sinaimg.cn/large/e3afbb56gy1g0nnylg28cg20rs01yjvw.gif
" style="width: 100%;"><table style="text-align:center;width:100%;" cellpadding="2" cellspacing="0" align="center" border="1" bordercolor="#999999">
	<tbody>
		<tr>
			<td>
				<a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#E53333;">仿115资源源码网下载<span></a>
			</td>
			<td>
				<a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#006400;">仿115资源源码网下载</span></a>
			</td>
			<td>
				<span style="color:#337FE5;font-size:14px;font-family:'Microsoft YaHei';"><a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF33CC;">仿115资源源码网下载</span></a>
			</td>
			<td>
				<div>
	<span style="color:#337FE5;font-size:14px;font-family:'Microsoft YaHei';"><a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#006400;">仿115资源源码网下载</a></span> 
</div>
			</td>
			<td>
				<a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">仿115资源源码网下载</span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#009900;">仿115资源源码网下载</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://158pan.cn/file-231402.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">仿115资源源码网下载</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://158pan.cn/file-177062.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">绿色版的115资源网源码下载</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://158pan.cn/file-177062.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">绿色版的115资源网源码下载</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://158pan.cn/file-177062.html" target="_blank"><span style="color:#0000FF;font-size:14px;font-family:'Microsoft YaHei';">绿色版的115资源网源码下载</span></a>
			</td>
		</tr>
				<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://158pan.cn/file-177062.html" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">绿色版的115资源网源码下载</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://158pan.cn/file-177062.html" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">绿色版的115资源网源码下载</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.hisoer.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">气质代刷网</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.hisoer.cn/" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">气质代刷网</span></a>
			</td>
			<td style="text-align:center;">
				<span class="visMsg"><a rel="external nofollow" href="http://www.hisoer.cn/" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">气质代刷网</span></a></span>
			</td>
		</tr>
						<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.hisoer.cn/" target=" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">气质代刷网</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://www.hisoer.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#D15FEE;">气质代刷网</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.hisoer.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#000000;">气质代刷网</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="color:#009900;font-size:14px;font-family:'Microsoft YaHei';">欢迎加入QQ群</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#FF0000;">欢迎加入QQ群</span></a>
			</td>
		</tr>
			<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">欢迎加入QQ群</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#009900;">欢迎加入QQ群</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#009900;">中国移动互联网流量卡</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="color:#FF33CC;font-size:14px;font-family:'Microsoft YaHei';">中国移动互联网流量卡</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#FF0000;">中国移动互联网流量卡</span></a>
			</td>
		</tr>
				<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="color:#0000FF;font-size:14px;font-family:'Microsoft YaHei';">每个月20元包100G</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF00FF;">每个月20元包100G</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.81936505.top/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">每个月20元包100G</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="color:#0000FF;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#000000;">文字广告位15/月</span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="color:#0000FF;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF00FF;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#009900;">文字广告位15/月</span></a>
			</td>
		</tr>
												<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#009900;">文字广告位15R/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="color:#009900;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#FF00FF;">文字广告位15/月</span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="color:#FF00FF;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://www.xr101.cn/" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#000000;">文字广告位15/月</span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#000000;">文字广告位15/月</span></a>
			</td>
		  </tr>
		  		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#000000;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#ff0000;">文字广告位15/月</span></a>
			</td>
		  </tr>
		  		  		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#0000FF;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#000000;">文字广告位15/月</span></a>
			</td>
		  </tr>
		  		  		  		<tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF8C00;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FF0000;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF0000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#0000FF;">文字广告位15/月</span></a>
			</td>
		  </tr>
		  		  		 <tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF1493;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#ff0000;">文字广告位15/月</span></a>
			</td>
		  </tr>
		  		  		  		 <tr>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#FF1493;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#FFFF00;">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
			<div>
	<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-size:14px;font-family:'Microsoft YaHei';color:#0000FF;">文字广告位15/月</span></a> 
</div>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="color:#000000;font-size:14px;font-family:'Microsoft YaHei';">文字广告位15/月</span></a>
			</td>
			<td style="text-align:center;">
				<a rel="external nofollow" href="http://tbk.ruoze.cc" target="_blank"><span style="font-family:'Microsoft YaHei';font-size:14px;color:#ff0000;">文字广告位15/月</span></a>
			</td>
		  </tr>
	</tbody>
</table>
  <!--首页图片广告位 结束-->
