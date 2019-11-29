<?php
define('EMLOG_ROOT', dirname(__FILE__));
require_once EMLOG_ROOT.'/config.php';
require_once EMLOG_ROOT.'/include/lib/function.base.php';
doStripslashes();
$CACHE = Cache::getInstance();
$userData = array();
define('BLOG_URL', Option::get('blogurl'));

$sort = isset($_GET['sort']) ? intval($_GET['sort']) : '';

$URL = BLOG_URL;
$blog = getBlog($sort);
$blogtitle = Option::get('blogname');
$user_cache = $CACHE->readCache('user');

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.Option::get('blogname').'网站地图</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SiteMap" />
<meta name="description" content="'.Option::get('bloginfo').'" />
<meta name="generator" content=" SiteMap " />  
<style type="text/css">
body {font-family: "Microsoft Yahei", Verdana, Tahoma;font-size: 12px;color: #000000;}
a, a:hover { color:#000000;}
h2 { text-align:center;}
#nav, #content, #footer {padding: 8px; border: 1px solid #EEEEEE; clear: both; width: 95%; margin: 10px auto;}
li { margin-top:8px;}
#foot {padding: 8px; clear: both; width: 95%; margin: 10px auto; text-align:center;}
</style>
</head>
<body>
<h2>'.Option::get('blogname').' 网站地图 </h2>
<div id="nav"><a href="'.$URL.'"><strong>'.Option::get('blogname').'</strong></a>  &raquo; <a href="'.$URL.'baidusitemap.php">站点地图</a></div><div id="content"><h3>最新文章</h3><ul>';

foreach($blog as $value){
	$link = Url::log($value['id']);
    $pubdate =  gmdate('Y-m-d',$value['date']);
	echo <<< END

<li><a href="$link" target="_blank">{$value['title']}</a>&nbsp;&nbsp;[发布时间：$pubdate ]</li>
END;
}
echo <<< END
</ul></div><div id="footer">查看博客首页: <strong><a href="$URL">$blogtitle</a></strong></div>





</body></html>

END;

/**
 * 获取日志信息
 *
 * @return array
 */
function getBlog($sort = null) {
	$DB = MySql::getInstance();
	$subsql = $sort ? "and sortid=$sort" : '';
	$sql = "SELECT * FROM ".DB_PREFIX."blog  WHERE hide='n' and type='blog' $subsql ORDER BY date DESC limit 0,500";
	$result = $DB->query($sql);
	$blog = array();
	while ($re = $DB->fetch_array($result))
	{
		$re['id'] 		= $re['gid'];
		$re['title']    = htmlspecialchars($re['title']);
		$re['date']		= $re['date'];
		$blog[] = $re;
	}
	return $blog;
}
