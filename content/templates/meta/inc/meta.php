<?php 
/**
 * 请勿随意修改该文件，以免出现各种问题！
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if(get_template_name() != 'meta'){echo "<script>alert('请将文件夹名字改为meta,以免模板出现问题！')</script>";}
define("Theme_Version","1.0");
?>
<script type="text/javascript">var metatheme = '<?php echo TEMPLATE_URL; ?>';var ThemeVersion = <?php echo Theme_Version;?>;var blog_url = '<?php echo BLOG_URL; ?>';</script>
