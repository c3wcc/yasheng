<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function  plugin_setting_view(){
	include(EMLOG_ROOT.'/content/plugins/bd_submit/bd_submit_config.php');
	?>
	<?php if(isset($_GET['setting'])):?><span class="actived">设置成功</span><?php endif;?>
	<h2>百度链接自动提交设置</h2>
	<form action="./plugin.php?plugin=bd_submit&action=setting" method="POST">
		<p>站点链接(不带http):<input style="margin-left: 20px;" name="site" type="text" value="<?php echo $config['site'];?>" /></p>
		<p>token:<input style="margin-left: 90px;" type="text" name="token" value="<?php echo $config['token'];?>" /></p>
		<p>显示记录前N条(0为全部显示):<input style="width: 125px;margin-left:10px" type="text" name="log_number" value="<?php echo $config['log_number'];?>"></p>
		<p>清除提交记录(勾选后修改设置会清理所有记录):<input type="checkbox" name="clean_log"></p>
		<p><input style="margin-left: 230px;" type="submit" value="修改设置"></p>
		<p>token与站点链接一一对应，如果错误插件无法正常工作   </p>
		<P>token请在百度平台：http://zhanzhang.baidu.com/linksubmit/index 手动获取 </P>
		<p>提交结果可以在 http://zhanzhang.baidu.com/sitemap/pingindex  查看 结果有一定延迟 </p>
		<p>提交错误请在<a href="http://blog.alw.pw/post-10.html">blog.alw.pw/post-10.html</a>查看错误原因，多参考他人评论或者留言</p>
		<p>清除提交记录将导致保存文章的时候会再次提交该文章！请慎重！慎重！慎重！重要的事情说三遍</p>
	</form>
	<?php 
	$submit_file = dirname(__FILE__).'/submit_log.txt';	
	$submit_logs = file_get_contents($submit_file);
	$submit_logs_info = explode("\r\n",$submit_logs);
	array_pop($submit_logs_info);
	?>
	<style type="text/css">
		td{
			padding-right: 5px;
		}
	</style>
	<table>
		<tbody>
		<tr><th>提交网址</th><th>提交状态</th><th>提交时间</th><th>错误原因</th></tr>
		<?php
		$i = ($config['log_number'] == 0) ? 0 : ($config['log_number'] + 1);

		foreach (array_reverse($submit_logs_info) as $submit_log) {
			$i--;
			if($i == 0) break;
			$submit_log_info = explode("||",$submit_log);
			if($submit_log_info[0] == 0)
				echo "<tr><td>".$submit_log_info[3]."</td><td>提交失败</td><td>".$submit_log_info[2]."</td><td>".$submit_log_info[1]."</td></tr>";
			else
				echo "<tr><td>".$submit_log_info[2]."</td><td>提交成功</td><td>".$submit_log_info[1]."</td><td>-</td></tr>";

		}
		?>
		</tbody>
	</table>	
	<?php
}

function plugin_setting(){
	if($_POST['clean_log'] == true){
		@file_put_contents(EMLOG_ROOT.'/content/plugins/bd_submit/submit_log.txt', "");
		@file_put_contents(EMLOG_ROOT.'/content/plugins/bd_submit/logid_log.txt', "");
	}
	$newconfig = '<?php
					$config =  array(
						"site" => "'.$_POST['site'].'",
						"token" => "'.$_POST['token'].'",
						"log_number" => "'.$_POST['log_number'].'" 
					);';
	@file_put_contents(EMLOG_ROOT.'/content/plugins/bd_submit/bd_submit_config.php', $newconfig);
}
?>