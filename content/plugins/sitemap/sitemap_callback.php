<?php
/*
Plugin Name: sitemap
Version: 3.0
Plugin URL: http://www.aihxl.com/sitemap.html
Description: 适用于 Emlog 6.0以上版本，供搜索引擎抓取，便于收录。
Author: 初心博客
Author Email: yang@aihxl.com
Author URL: http://www.aihxl.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function callback_init() {
	require_once EMLOG_ROOT . '/content/plugins/sitemap/class.sitemap.php';
	require_once EMLOG_ROOT . '/content/plugins/sitemap/sitemap.php';
	extract(sitemap_config());
	$sitemap = new sitemap($sitemap_name);
	$sitemap->build();
}