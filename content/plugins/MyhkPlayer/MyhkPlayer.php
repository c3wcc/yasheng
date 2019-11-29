<?php
 /**
 * Plugin Name: 明月浩空音乐播放器
 * Version: 20190708
 * Plugin URL: http://limh.me
 * Description: 基于网易，QQ音乐歌曲ID全自动解析的Html5浮窗音乐播放器
 * Author: 明月浩空
 * Author Email: admin@limh.me
 * Author URL: http://limh.me
 */
!defined('EMLOG_ROOT') && exit('access deined!');
function MyhkPlayer(){
	require_once 'MyhkPlayer_config.php';
	if($config["jq"]=="open"){
		echo '<script src="//lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>'."\n";
	}
	if($config["mb"]=="open"){
		echo '<script id="myhk" src="https://' . $config["xl"] . '.limh.me/player/js/player.js" key="' . $config["id"] . '" m="1"></script>'."\n";
	}else{
		echo '<script id="myhk" src="https://' . $config["xl"] . '.limh.me/player/js/player.js" key="' . $config["id"] . '"></script>'."\n";
	}
}
function MyhkPlayer_menu() {
	echo '<div class="sidebarsubmenu" id="MyhkPlayer"><a href="./plugin.php?plugin=MyhkPlayer"><img src="'.BLOG_URL.'content/plugins/MyhkPlayer/style/logo.png" align="middle" style="margin-top:-10px"/>明月浩空音乐</a></div>';
}
addAction('index_footer', 'MyhkPlayer');
addAction('adm_sidebar_ext', 'MyhkPlayer_menu');