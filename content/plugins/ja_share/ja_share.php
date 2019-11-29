<?php
/**
 * Plugin Name: 分享插件
 * Version: 1.0
 * Plugin URL: http://blog.gouji.org
 * Description: 分享博客内容至 QQ空间 QQ好友 QQ微博
 * Author: 简爱
 * Author Email: sc.419@qq.com
 * Author URL: http://blog.gouji.org
**/


!defined('EMLOG_ROOT') && exit('access deined!');

define("JA_SHARE_ROOT", dirname(__FILE__));
define("JA_SHARE_URL", BLOG_URL . 'content/plugins/ja_share/');




addAction('log_related', 'ja_share_log_related');
addAction('index_footer', 'ja_share_footer');

function ja_share_log_related($logD){
  extract($logD);

  $descArr = array( // 分享里有 随机调用
    '文章写得不错值得你一看',
    '可以给你 100 个赞',
  );

  $len = 100; // 文章内容 截取长度

  $data = ja_share_get_html($log_content, $len);

  $json = array(
    'title' => $log_title,
    'summary' => $data,
    'desc' => $descArr[array_rand($descArr)],
    'site' => 'blog.gouji.org',
  );
  if($img = ja_share_getImg($log_content)) $json['pics'] = $img;
  $json = json_encode($json);

  echo "<div class='ja_share'>分享本文至： <a ja_share='qz'><i class='ja_share_qz'></i></a> <a ja_share='qq'><i class='ja_share_qq'></i></a> <a ja_share='twb'><i class='ja_share_twb'></i></a>  </div>";

  echo "<script type=\"text/javascript\">var JA_SHARE = $json;</script>";
}

function ja_share_footer(){
  $url = BLOG_URL . "content/plugins/ja_share";
  echo '
<link rel="stylesheet" href="'.$url.'/css/style.css"/>
<script src="'.$url.'/ja_share.js"></script>';
}


function ja_share_get_html($html, $len){
  $search = array("/([\r\n])[\s]+/",
    "/&(quot|#34);/i", "/&(amp|#38);/i",
    "/&(lt|#60);/i", "/&(gt|#62);/i",
    "/&(nbsp|#160);/i", "/&(iexcl|#161);/i",
    "/&(cent|#162);/i", "/&(pound|#163);/i",
    "/&(copy|#169);/i", "/\"/i",
  );
  $replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
  $data = trim(strip_tags($html));
  $data = preg_replace($search, $replace, $data);
  return iconv_substr($data, 0, $len, 'utf-8');
}

function ja_share_getImg($log_content){
  if(preg_match("/<img.*src=[\"|'](.*)[\"|']/Ui", $log_content, $IMG_ARR) && !empty($IMG_ARR[1])) return $IMG_ARR[1];
  return false;
}
