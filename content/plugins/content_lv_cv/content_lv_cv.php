<?php
/**
* Plugin Name: 登录&回复可见隐藏内容
* Version: 1.4
* Author: 小东
* Author URL: https://blog.dyboy.cn/resume.html
* Plugin URL: https://blog.dyboy.cn/develop/33.html
* Description: 可以在文章内容或者页面内容中预设隐藏内容，当用户通过评论后或者登陆后才能查看隐藏的内容。</br>内容模板echo_log.php或页面模板page.php必须加入"&lt;?php doAction('log_related', $logData); ?&gt;
"挂载点语句。
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
function content_lv_cv_user($logid){
	if (!empty($_SESSION['nickname'])){
		$db=Database::getInstance();
		$sql = "SELECT cid FROM " . DB_PREFIX . "comment WHERE gid='".$logid."' and poster='".$_SESSION['nickname']."' LIMIT 1";
		$row = $db -> once_fetch_array($sql);
		if ($row) return 1;
	}
}
function content_lv_cv_x(){
	$content = ob_get_clean();
	$content = preg_replace("/\[[c|l]v\](.*?)\[\/[c|l]v\]/is", '', $content);
	ob_start();
	echo $content;
}
function content_lv_cv($logData){
	if(preg_match('/\[[c|l]v\](.*?)\[\/[c|l]v\]/is', $logData['log_content'])){
	    $logid = $logData['logid'];
		$content = ob_get_clean();
		$css ='<style type="text/css">
		.cl_content{
		border:1px dashed #ff9a9a;background:#ffffe0;padding:5px 0 5px 25px;margin:5px auto;color:#FF0000;line-height:26px;text-align:center;}
		</style>';
		$content =$content.$css;
		if(preg_match('/\[cv\](.*?)\[\/cv\]/is', $content,$temp)){
			if(content_lv_cv_user($logid) || isset($_COOKIE["comment_cv_".$logid]) || ROLE == "admin"){
				$content = preg_replace("/\[cv\](.*?)\[\/cv\]/is", '
				\1', $content);
			}else{
				$content = preg_replace("/\[cv\](.*?)\[\/cv\]/is", '
				<div class="cl_content"><img sec="./content/plugins/content_lv/_cv/locked.gif" style="display:inline-block;vertical-align: middle;">此处内容已隐藏，<a href="#comment-post">评论</a>后刷新即可查看！</div>', $content);
			}
		}
		if(preg_match("/\[lv\](.*?)\[\/lv\]/is", $content,$temp)){
			if(ISLOGIN){
				$content = preg_replace("/\[lv\](.*?)\[\/lv\]/is", '
				\1', $content);
			}else{
				$content = preg_replace("/\[lv\](.*?)\[\/lv\]/is", '
				<div class="cl_content">此处内容已隐藏，登录后即可查看！</div>', $content);
			}
		}
		ob_start();
		echo $content;
	}
}
function comment_saved_cv(){
	setcookie("comment_cv_".$_POST['gid'], "1", time()+259200, "/");
}
// dyboy 2019-5-21 21:26:34
function content_lv_cv_Button(){
	echo '   

手动复制代码： [cv]回复可见内容[/cv]   [lv]登陆见内容[/lv]


		<script>
			$(document).ready(function(){
				$("#Button_lv").click(function(){
					editorMap["content"].insertHtml("<p>[lv]这里替换成需要登录可见的内容[/lv]</p>");  
				});
				$("#Button_cv").click(function(){
					editorMap["content"].insertHtml("<p>[cv]这里替换成需要评论可见的内容[/cv]</p>");
				});
			});
		</script>';
}
addAction('adm_writelog_head', 'content_lv_cv_Button');
addAction('index_head','content_lv_cv_x');
addAction('log_related','content_lv_cv');
addAction('comment_saved', 'comment_saved_cv');