<?php
/*
Plugin Name: 友链自助添加
Version: 2.0
Plugin URL:https://blog.dyboy.cn/develop/119.html
Description: 判断申请友链的网站是否先添加了本网站的友链,然后再加上该站友链<br/>升级界面，安全过滤。
ForEmlog:5.3.1+
Author: 小东/DYBOY
Author URL: https://blog.dyboy.cn/
*/
!defined('EMLOG_ROOT') && exit('Hello Hacker!');
function link_web() {
	if($_GET['link_t']=="1"){
		$bl_link = addslashes($_POST['url']). '/';
		$bl_web_name = addslashes($_POST['web_name']);
		$bl_web_description = addslashes($_POST['web_description']);
		$bl_cxl=mysql_query("SELECT  * from ".DB_PREFIX."link where siteurl='$bl_link'"); 
		$bl_cxt=mysql_query("SELECT  * from ".DB_PREFIX."link where sitename='$bl_web_name'"); 
		if($bl_link !="" and $bl_web_name!="" ){
			$name = @file_get_contents($bl_link);
			$pan = $_SERVER['HTTP_HOST']; 
			$con = explode($pan, $name); 
			if (count($con)>1 && mysql_num_rows($bl_cxl)==0 && mysql_num_rows($bl_cxt)==0):
				$sql_bl_cr = mysql_query("INSERT INTO ".DB_PREFIX."link (sitename,siteurl,description,taxis,hide)VALUES ('$bl_web_name','$bl_link','$bl_web_description','14','n')");
	?>
				<iframe src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/content/plugins/link_web/cache.php"  style="display:none;"></iframe>
				<script type="text/javascript">
					alert("添加成功！欢迎常来哦！*^_^*");
					history.go(-1); 
					location.reload();
				</script>
			<?php
			else: 
			?>
				<script type="text/javascript">
					alert("贵站还未先添加上本站的友链！\n或已经添加成功,请不要重复添加！");
					history.go(-1); 
					location.reload();
				</script>
			<?php 
			endif;
		}
		else{
		?>
			<script type="text/javascript">
				alert("名称和网址为必填项额(⊙o⊙)…");
				history.go(-1); 
				window.location.href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"
			</script>
		<?php 
		}
	}
	?>
	
	<link rel="stylesheet" href="<?php echo BLOG_URL;?>content/plugins/link_web/link_web_auto.css" type="text/css">
	<div class="link_web">
		<form action="?link_t=1" method="post">
			<div style="text-align:center;"><strong style="line-height:1.5;"><span style="color: #409eff;font-size:16px;">友情连接自助添加</span></strong></div>
			<input name="web_name" placeholder="网站名称" class="link_url" required />
			<input name="url" placeholder="网站地址(需要http://)" class="link_url" type="text" required />
			<textarea rows="4" cols="50" name="web_description" placeholder="请填写贵站的描述。注意：申请友链前请首先添加本站链接哦！" class="web_description"></textarea>
			<input name="submit" class="btn" type="submit" value="提交申请" />
		</form>
	</div>
<?php 
}

addAction('link_web_echo', 'link_web');
?>