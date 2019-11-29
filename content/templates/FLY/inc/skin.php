<?php 
/**
 * 请勿随意修改该文件，以免出现各种问题！
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if(get_template_name() != 'FLY'){echo "<script>alert('请将文件夹名字改为FLY,以免模板出现问题！')</script>";}
?>
<?php
$nonce_templet = Option::get('nonce_templet');
$nonceTplData = @implode('', @file(TPLS_PATH.$nonce_templet.'/header.php'));
preg_match("/Version:(.*)/i", $nonceTplData, $tplVersion);
define('Theme_Version' , !empty($tplVersion[1]) ? $tplVersion[1] : '' );
$api_url = 'https://fly.pjax.cn/';
function curls($url, $timeout = '5')  {
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);	
	curl_setopt($ch, CURLOPT_HEADER, 0);  
	$info = curl_exec($ch);  
	curl_close($ch);  
	return $info;  
}
?>
<script type="text/javascript">
var pjaxtheme = '<?php echo TEMPLATE_URL; ?>';
var api_url = '<?php echo $api_url;?>';
var blog_url = '<?php echo BLOG_URL; ?>';
var pjax_id = '#<?php echo get_template_name(); ?>';
var ThemeVersion = <?php echo Theme_Version;?>;
</script>
<style><?php if($Tconfig["bg_open"]== 1 ){?>body{background: url('<?php echo TEMPLATE_URL."img/bg.png";?>') top center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}.bg-fixed{width:100%;height:100%;position:fixed;top:0;left:0;z-index:-998;background:url('<?php echo TEMPLATE_URL; ?>img/bg-fixed.png') repeat}<?php }?>.sidebar.fixed{position:fixed;left:50%;bottom:0;margin-left:230px;}.sidebar.pins{position:absolute;left:50%;margin-left:230px;right:386px}<?php if($Tconfig["wowslider"] =='2'){ echo "@media screen and (max-width:800px){#wowslider-container1{display:none!important;}}";} ?>
<?php if($Tconfig["theme_skin"]!='16C0F8'):?>
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.dropdown>a:focus,.navbar-default .navbar-nav>.dropdown>a:hover,.navbar-default .navbar-nav>li>a:hover,.navbar-default .navbar-nav>.open>a,.navbar-default .navbar-nav>.open>a:focus,.navbar-default .navbar-nav>.open>a:hover{color: <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;background-color: transparent}.btn-info{background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;border-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.btn-info:hover{background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;border-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}#post-box .post-title,#post-box .post-title{border-left: 5px solid <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.panel_cms li a:hover,.posts-default-title h2 a:hover{color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.pagination ul>.active>span{background:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;color:#fff}.related-posts>li .related-posts-panel:hover{border-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;box-shadow:0 0 2px <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;-moz-box-shadow:0 0 2px <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.context img:hover{border-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;box-shadow:0 0 2px <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;-moz-box-shadow:0 0 2px <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.context a{border-bottom:1px solid <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.grid-weibo-show .u-btn-submit{border:1px solid <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;background:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.link-li>a:hover,.sidebar-posts-list>li .side-title-r>a:hover,.sidebar-posts-list>li .side-title>a:hover,.sidebar-posts-list>li>a:hover,.author a:hover,.pagination>li>a,.pagination>li>span,.page-navi .current,.page-navi .pages,.page-navi a,.comments-list li .right-box>.comment-meta .edit-link a,.comments-list li .right-box>.comment-meta .reply a,.comments-list li .right-box>.waiting,.tw li:hover .tw-content,.page-tw a,ul.readers-list a:hover em,ul.readers-list a:hover strong,.posts-gallery-content h2 a:hover{color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.focusmo a:hover h4{background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;opacity:.8}.backtop:hover{background:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;border:1px solid <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;color:#fff}.comments-list-nav span,.tw li:hover .atitle:after{background:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.page-navi .current,.page-navi a:hover{background:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;border-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;color:#FFF}.page-tw span,.page-tw a:focus,.page-tw a:hover,ul.readers-list img:hover{background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}::-webkit-scrollbar-thumb{background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}.logtop dl p .spbut:hover{border:1px solid <?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>;background-color:<?php if($Tconfig["theme_skin_custom"] ==''){ echo "#".$Tconfig["theme_skin"];}else{ echo $Tconfig["theme_skin_custom"];}?>}
<?php endif;?><?php echo $Tconfig["zdy_css"]; ?>
</style>
