<?php
/**
 * @description  自带sitemap小工具：全部输出xml
 * @authors      Jea杨 (JJonline@JJonline.Cn)
 * @date         2015-08-22
 * @version      1.0
 */
#error_reporting(E_ALL);
$InitFile   =   realpath('../../../init.php');
if(!is_file($InitFile)) {die('Template Dir Error!');}
ini_set('date.timezone','Asia/Shanghai');
#包含入口文件
require_once $InitFile;
#开发环境 引入函数库 生产环境不需要
#require_once './functions.php';

#静态化以及一定时间后自动更新静态化xml文件 暂不实现
// if(file_exists(EMLOG_ROOT.'SiteMap.xml')) {

// }

#xml格式输出
header("Content-type:text/xml");
#实例化相关类
$DbModel    =   Database::getInstance();
$Cache      =   Cache::getInstance();
$XMLData    =   array();

/*
#Url模式
#0默认get参数 http://b.jjonline.cn/?post=1
#1文件形式：http://b.jjonline.cn/post-1.html 
#2目录形式：http://b.jjonline.cn/post/1 
#3分类形式：http://b.jjonline.cn/category/1.html
$UrlModle   =   Option::get('isurlrewrite');
#是否启用文章别名功能
$isAlias    =   Option::get('isalias')=='y';
#是否启用html后缀，模仿静态化的html格式
$isSuffix   =   Option::get('isalias_html')=='y';
*/

#count文章条数 blog
// $Sql        =   "SELECT COUNT(*) AS J_count FROM `".DB_PREFIX."blog` WHERE `type` = 'blog' AND `hide` = 'n'";
// $res        =   $DbModel->query($Sql);
// $row        =   $DbModel->fetch_array($res);
// $BlogCount  =   $row['J_count'];
// $res        =   $Cache->readCache('sta');
// $BlogCount  =   $res['lognum'];
// #count页面条数 blog
// $Sql        =   "SELECT COUNT(*) AS J_count FROM `".DB_PREFIX."blog` WHERE `type` = 'page' AND `hide` = 'n'";
// $res        =   $DbModel->query($Sql);
// $row        =   $DbModel->fetch_array($res);
// $PageCount  =   $row['J_count'];

#关键词数据 tag
$TagsArr    =   $Cache->readCache('tags');

#分类数据 sort
$SortArr    =   $Cache->readCache('sort');

#归档数据 record
$RecordArr  =   $Cache->readCache('record');


#xml数据收集

#日志
$Sql                    =   "SELECT `gid`,`date`,`comnum`,`views` FROM `".DB_PREFIX."blog` WHERE `type` = 'blog' AND `hide` = 'n' ORDER BY `gid` DESC";
$res                    =   $DbModel->query($Sql);
while($row  =  $DbModel->fetch_array($res)) {
    $cache              =  array();
    $cache['loc']       =  Url::log($row['gid']);
    $cache['lastmod']   =  date('Y-m-d',$row['date']);
    $cache['changefreq']=  'daily';
    $cache['priority']  =  $row['views']<=10000 || $row['comnum']<1 ? '0.9' : '1.0';
    $XMLData[]          =  $cache; 
}
#独立页面
$Sql                    =   "SELECT `gid`,`date`,`comnum`,`views` FROM `".DB_PREFIX."blog` WHERE `type` = 'page' AND `hide` = 'n' ORDER BY `gid` DESC";
$res                    =   $DbModel->query($Sql);
while($row  =  $DbModel->fetch_array($res)) {
    $cache              =  array();
    $cache['loc']       =  Url::log($row['gid']);
    $cache['lastmod']   =  date('Y-m-d',$row['date']);
    $cache['changefreq']=  'daily';
    $cache['priority']  =  $row['views']<=500 || $row['comnum']<1 ? '0.9' : '1.0';
    $XMLData[]          =  $cache; 
}
#归档
foreach ($RecordArr as $key => $value) {
   $cache               =  array();
   $cache['loc']        =  Url::record($value['date']);
   $cache['changefreq'] =  'Weekly';
   $cache['priority']   =  '0.3';
   $XMLData[]           =  $cache;
}
#关键词
foreach ($TagsArr as $key => $value) {
   $cache               =  array();
   $cache['loc']        =  Url::tag($value['tagurl']);
   $cache['changefreq'] =  'Weekly';
   $cache['priority']   =  '0.3';
   $XMLData[]           =  $cache;
}
#分类
foreach($SortArr as $key => $value) {
   $cache               =  array();
   $cache['loc']        =  Url::sort($key);
   $cache['changefreq'] =  'Weekly';
   $cache['priority']   =  '0.3';
   $XMLData[]           =  $cache;
}

#输出
$XmlString       =   '';#字符串变量收集之后再输出主要是为了适配静态化该xml
$XmlString      .=   '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$XmlString      .=   '<?xml-stylesheet type="text/xsl" href="'.TEMPLATE_URL.'inc/sitemap.xsl"?>'.PHP_EOL;
$XmlString      .=   '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;
foreach ($XMLData as $key => $value) {
    $XmlString  .=   '<url>'.PHP_EOL;
    $XmlString  .=   '    <loc>'.$value['loc'].'</loc>'.PHP_EOL;
    if(isset($value['lastmod'])) {
      $XmlString.=   '    <lastmod>'.$value['lastmod'].'</lastmod>'.PHP_EOL;  
    }
    $XmlString  .=  '    <changefreq>'.$value['changefreq'].'</changefreq>'.PHP_EOL;
    $XmlString  .=  '    <priority>'.$value['priority'].'</priority>'.PHP_EOL;
    $XmlString  .=  '</url>'.PHP_EOL;
}
$XmlString      .=  '</urlset>';
echo $XmlString;