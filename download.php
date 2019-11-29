<?php
/**
 * 文件下载页面
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';
$id=addslashes($_GET['id']);
$options_cache = $CACHE->readCache('options');
$db = MySql::getInstance();
$data = $db->query("SELECT * FROM ".DB_PREFIX."cpdown WHERE logid ='$id'");
$row = $db->fetch_array($data);
$logData = array(
  'start' => htmlspecialchars($row['start']),
  'name' => htmlspecialchars($row['name']),
  'size' => htmlspecialchars($row['size']),
  'up_date' => htmlspecialchars($row['up_date']),
  'version' => htmlspecialchars($row['version']),
  'author' => htmlspecialchars($row['author']),
  'yanshi' => htmlspecialchars($row['yanshi']),
  
  'baidudown' => htmlspecialchars($row['baidudown']),
    'baidumima' => htmlspecialchars($row['baidumima']),
  'web' => htmlspecialchars($row['web']),
  'ctldown' => htmlspecialchars($row['ctldown']),
  'general' => htmlspecialchars($row['general'])
);
$title = $logData['name'];
if(!empty($logData['baidumima'])){$baidumima = '百度网盘密码：'.$logData['baidumima'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}

if(!empty($logData['baidudown'])){
  $baidudown = '<span class="downfile"><a href="'.$logData['baidudown'].'" target="_blank">百度网盘</a></span>';
}
if(!empty($logData['web'])){
  $web = '<span class="downfile"><a href="'.$logData['web'].'" target="_blank">官方下载<font color="white">(推荐)</font></a></span>';
}
if(!empty($logData['ctldown'])){
  $ctldown = '<span class="downfile"><a href="'.$logData['ctldown'].'" target="_blank">蓝秦网盘<font color="white">(推荐)</font></a></span>';
}
if(!empty($logData['general'])){
  $general = '<span class="downfile"><a href="'.$logData['general'].'" target="_blank">普通下载</a></span>';
}
?>
<script>if("<?php echo URL::log($id); ?>"!=document.referrer){alert("请从文章页面进入下载单页！");window.location.href="<?php echo URL::log($id); ?>";}</script><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-transform " />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo $title; ?> - <?php echo $options_cache['blogname']; ?></title>
<link href="/content/plugins/cpdown/style/show.css" type="text/css" rel="stylesheet" />
<link href="http://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="http://apps.bdimg.com/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="/content/plugins/cpdown/style/show.js" type="text/javascript"></script>
</head>
<body>
<div class="topbar">
  <div class="top">
    <div class="top_left">您好，欢迎进入雅尚博客下载页面！</div>
    



  </div>
</div>


<div class="wrap">
<div class="content">

<div class="plus_box">
<div class="plus_l">
  <ul>
   
    <li>文件名称 ：<?php echo $logData['name']; ?></li>
    <li>文件大小 ：<?php echo $logData['size']; ?></li>
    <li>适用版本 ：<?php echo $logData['version']; ?></li>
    <li>作者信息 ：<?php echo $logData['author']; ?></li>
    <li>下载密码 ：<?php echo $baidumima.$tszwpmima; ?></li>
    <li>更新时间 ：<?php echo $logData['up_date']; ?></li>
    <li>推荐级别 ：<span class="xing_e"></span></li>
  </ul>
</div>
<div class="plus_r"><div class="diybox"><img src="<?php echo BLOG_URL; ?>content/plugins/cpdown/style/nozanzhu.png" width="300" height="300" alt="<?php echo $options_cache['blogname']; ?>"></div></div>
</div>
<div class="panel">
 <div class="panel-heading">
   <h3>下载地址</h3>
 </div>
 <div class="panel-body">
  <?php echo $baidudown,$web,$ctldown,$general; ?>
 </div>
</div>
<div class="panel">
 <div class="panel-heading">
   <h3>下载说明</h3>
 </div>
 <div class="panel-body">
  <ul class="help">
    <li>1、本站提供的压缩包若无特别说明，解压密码均为<em>www.yashang.ink</em></li>
    <li>2、下载后文件若为压缩包格式，请安装7Z软件或者其它压缩软件进行解压</li>
	<li>3、文件比较大的时候，建议使用下载工具进行下载，浏览器下载有时候会自动中断，导致下载错误</li>
	<li>4、资源可能会由于内容问题被和谐，导致下载链接不可用，遇到此问题，请到文章页面进行反馈，我们会及时进行更新的</li>
	<li>5、其他下载问题请自行搜索教程，这里不一一讲解</li>
  </ul>
 </div>
</div>
<div class="panel">
 <div class="panel-heading">
   <h3>站长声明</h3>
 </div>
 <div class="panel-body">
  <span class="shengming">本站大部分下载资源收集于网络，只做学习和交流使用，版权归原作者所有，若为付费资源，请在下载后24小时之内自觉删除，若作商业用途，请到原网站购买，由于未及时购买和付费发生的侵权行为，与本站无关。本站发布的内容若侵犯到您的权益，请联系本站删除，我们将及时处理！</span>
 </div>
</div>
</div>
<div class="footer">
<p>Copyright © <?php echo date('Y'); ?> <a href="<?php echo BLOG_URL; ?>" title="<?php echo $options_cache['blogname']; ?>"><?php echo $options_cache['blogname']; ?></a></p>
</div>

</div>
</body>
</html>

