<?php
/*
Template Name:CoolColour 1.2
Description:酷彩绚色随你变换
Version:1.2
Author:IT技术宅
Author Url:http://www.12580sky.com
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" user-scalable="no" />
<!--CSS-->
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/default.css"/>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/public.css"/>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/animation.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/skin_2.css"title="jianyue" />
<link rel="stylesheet" type="text/css"href="<?php echo TEMPLATE_URL; ?>css/skin_1.css"title="qingxin" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/skin_3.css"title="qingshuang" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/font-icon.css"/>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/flexslider.css"/>
<link rel='stylesheet' href='<?php echo TEMPLATE_URL; ?>css/font-awesome.min.css' />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/jquery.fancybox.css">
<link href="http://libs.baidu.com/fontawesome/4.2.0/css/font-awesome.css" rel="stylesheet" type="text/css">
<!--JS-->
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.2.1.4.min.js"></script >
<script src="<?php echo TEMPLATE_URL; ?>js/my.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/superbg.min.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.flexslider-min.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/tooltip.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.pjax.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.fancybox.pack.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/prettify.js"></script>
<!--[if lte IE 8]>
	<script>window.location.href='http://cdn.dmeng.net/upgrade-your-browser.html?referrer='+location.href;</script>
<![endif]-->

<?php doAction('index_head'); ini_set('date.timezone','Asia/Shanghai');?>
</head>
<body class="nobg">
<script type="text/javascript">
    $(function () {
        //图片特效链接
        $("a[href$=jpg],a[href$=png],a[href$=gif],a[href$=jpeg],a[href$=bmp]").attr("data-fancybox-group","gallery").fancybox();
    });
    $(document).pjax('a[target!=_blank]:not(.commt_box a)', '.mysection', {fragment:'.mysection', timeout:5000});
    //这是提交表单的pjax。form表示所有的提交表单都会执行pjax，比如搜索和提交评论，可自行修改改成你想要执行pjax的form id或class。#content 同上改成你主题的内容主体id或class。
    $(document).on('submit', '.from_pjax', function (event) {$.pjax.submit(event, '.mysection', {fragment:'.mysection', timeout:6000});});
    $(document).on('pjax:send', function() {
        //$("#pjax-loading").css("display", "block");
		//$("body").attr("class","mn");
		$("#pjax-loading").show();
    });
    $(document).on('pjax:complete', function() {
		prettyPrint();
        //$("#pjax-loading").css("display", "none");
		//$("body").removeAttr("class");
		$("#pjax-loading").hide();
        sweetTitles.init();//tooltip
        $("a[href$=jpg],a[href$=png],a[href$=gif],a[href$=jpeg],a[href$=bmp]").attr("data-fancybox-group","gallery").fancybox();
		huidiao();
    });
	$(function(){
		prettyPrint();
	});
	<?php bgimg(); ?>

</script>
<!--导航开始-->

<header class="myheader">
	<div class="top">
		<!--头像左边部分-->
		<div class="top-left">
		  <div class="logo"><a href="/"><img src="/content/templates/CoolColour/images/logo.png"/></a></div>
				<!--滚动消息-->
			<div class="web-xiaoxi">
				<i class="el-speaker"></i>
				<ul class="mulitline">
					<?php dhmessage(); ?>
				</ul>
			</div>
				<!--END 消息 -->
			<!--手机菜单按钮-->
			<div class="mobile-nav"><i class="el-lines"></i><i class="el-remove"></i></div>
		</div>
	<!--电脑导航开始-->
		<nav class="mynav">
			<ul class="orange-text">
				<?php m_sort(1); ?>
			</ul>
		</nav>
		
		<!--这里是手机导航-->
		<div class="mob-menu">
		<!--手机顶部搜索-->
			<div class="search ">
				<form action="/Search/" method="get">
					<div class="search-index">
						<input name="s" type="text"  placeholder="请输入关键字" onfocus="this.placeholder=''" onblur="this.placeholder='请输入关键字'"/>
						<i class="el-search"><input value=" "type="submit"/></i>
					</div>
				</form>
			</div>
			<!--手机下拉菜单-->
			<ul class="mob-ulnav">
				<?php m_sort(2); ?>
			</ul>
			</div>
	</div>
<!--换肤--->
<script src="<?php echo TEMPLATE_URL; ?>js/skin.js"></script>
<div class="select-skin">
<div class="skin-btn">
    <a href="javascript:void(0);" class="skin-btn-open">背<br>景</a>
</div>

<div class="skin-content">
    <h1>选择风格<span class="skin-close">关闭</span></h1>
    <div class="skin-content-list">
	<div class="skin-list"><a href="#" onclick="setActiveStyleSheet('jianyue'); return false;" class="btn1">清新</a></div>
        <div class="skin-list"><a href="#" onclick="setActiveStyleSheet('qingxin'); return false;" class="btn2">简约</a></div>
		 <div class="skin-list"><a href="#" onclick="setActiveStyleSheet('qingshuang'); return false;" class="btn3">清爽</a></div>
    </div>
</div>
</div>
	<style type="text/css">
        body{cursor:url(/571614181-1.cur),default;}
        a:hover,li:hover,img:hover{cursor:url(/571614181-2.cur),pointer;}
						</style>
</header>
<!--导航结束-->
