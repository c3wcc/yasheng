<?php 
/**
 * 侧边栏
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<aside class="sidebar">
	<ul class="row">
<?php 
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
doAction('diff_side');
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>
<?php
$db = Database::getInstance();
$sta_cache = array();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE role = 'admin'");
$blog_admin = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE  top = 'y' or sortop = 'y' AND type = 'blog'");
$log_top = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'blog WHERE type = \'blog\'');
$log_total = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'comment');
$log_com = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'link');
$log_link = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'sort');
$log_sort = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'tag');
$log_tag = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "twitter");
$wei_yu = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE type = 'page'");
$log_page = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'user');
$count_user = $data['total'];
$sql = 'SELECT * FROM ' . DB_PREFIX . 'blog WHERE type=\'blog\' ORDER BY date DESC LIMIT 0,1';
$res = $db->query($sql);
$row = $db->fetch_array($res);
$date = date('n月j日', $row['date']);
?>
<?php if($Tconfig['cbads']== "1"){?>
<li class="widget widget_ui_ad" data-aos="<?php echo $Tconfig['aosxg'];?>">
	<ul>
	    <li><div class="aditem">
			<a class="list-group-item list-group-item-success adli" href="<?php echo $Tconfig['cdurl1']; ?>" target="_blank"><?php echo $Tconfig['cbbt1']; ?></a><div class="adtooltip"><p>
			<?php echo $Tconfig['cbts1']; ?></p><div class="adarrow"></div></div></div>
		</li>
	    <li><div class="aditem">
	        <a class="list-group-item list-group-item-info adli" href="<?php echo $Tconfig['cdurl2']; ?>" target="_blank"><?php echo $Tconfig['cbbt2']; ?></a><div class="adtooltip"><p>
			<?php echo $Tconfig['cbts2']; ?></p><div class="adarrow"></div></div></div>
		</li>
	    <li><div class="aditem">
	        <a class="list-group-item list-group-item-warning adli" href="<?php echo $Tconfig['cdurl3']; ?>" target="_blank"><?php echo $Tconfig['cbbt3']; ?></a><div class="adtooltip"><p><?php echo $Tconfig['cbts3']; ?></p><div class="adarrow"></div></div></div>
		</li>
	    <li><div class="aditem">
	        <a class="list-group-item list-group-item-danger adli" href="<?php echo $Tconfig['cdurl4']; ?>" target="_blank"><?php echo $Tconfig['cbbt4']; ?></a><div class="adtooltip"><p><?php echo $Tconfig['cbts4']; ?></p><div class="adarrow"></div></div></div>
		</li>
	</ul>
</li>
<?php }?>
<li class="widget widget_ui_statistics" data-aos="<?php echo $Tconfig['aosxg'];?>">
  <div class="widget-title"><span class="icon"><i class="fa fa-signal"></i></span>
    <h3>网站统计</h3>
  </div>
	<ul>
	    <li>本站管理：<?php echo $blog_admin;?>位</li>
		<li>用户总数：<?php echo $count_user;?>位</li>
		<li>置顶文章：<?php echo $log_top;?>篇</li>
		<li>日志总数：<?php echo $log_total;?>篇</li>
	    <li>微语总数：<?php echo $wei_yu;?>条</li>
		<li>评论总数：<?php echo $log_com;?>条</li>
		<li>标签总数：<?php echo $log_tag;?>条</li>
		<li>页面总数：<?php echo $log_page;?>页</li>
		<li>分类总数：<?php echo $log_sort;?>个</li>
		<li>链接总数：<?php echo $log_link;?>条</li>
		<li>运行天数：<?php echo floor((time()-strtotime($Tconfig['timedate']))/86400); ?>天</li>
		<li>最近更新：<?php echo $date;?></li>
	</ul>
</li>
</ul>
</aside>

