<?php
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){include View::getView('setting');exit();}
if(isset($_GET["meta"])){include View::getView('user/index');exit;}
?>
<!--广告位1-->
<?php if($Tconfig["add_gg"]== 1 ){?>
<div class="add-gg">
	<a href="<?php echo $Tconfig["add_url1"]; ?>" target="_blank" rel="nofollow" title=""><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $Tconfig["add_tu1"]; ?>" alt="" class="lazy"></a>
</div>
<?php }?>
<!--区域1-->
<div class="new-content">
	<div class="new-left">
		<div class="mslider">
         <ul class="mslider-main">
		<?php Slide();?>			
		</ul>
		</div>
		<div class="new-tag">
			<div class="new-title">随机云标签</div>
			<div class="new-tags">
				<?php yun_tags();?>				
			</div>
		</div>
	</div>
	<div class="new-right">
		<div class="new-title">最近更新</div>
		<div class="new-update">
			<ul id="newcontent">
			<?php  if (!empty($logs)): foreach($Log_Model->getLogsForHome("order by date DESC",$page,120) as $value):  ?>	
				<li>
				<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>" <?php if(((date('Ymd',time())-date('Ymd',$value['date']))< 1)){?>class="new-time"<?php }?>><?php echo $value['log_title']; ?></a>
				<font <?php if(((date('Ymd',time())-date('Ymd',$value['date']))< 1)){?>class="new-time"<?php }?>><?php echo gmdate('m月d日', $value['date']); ?></font>
				</li>	
			<?php  endforeach; else: ?>
			<?php endif;?>		
			</ul>		
		</div>		
		<div class="new-page"></div>
	</div>
</div>
<!--首页三格-->
<?php if($Tconfig["sange_more"]== 1 ){?>
<ul class="index-add">
	<li><img src="<?php echo $Tconfig["tubiao1"]; ?>"><div><h3><?php echo $Tconfig["sange_biaoti1"]; ?></h3><span><?php echo $Tconfig["sange_jianjie1"]; ?></span></div><a href="<?php echo $Tconfig["sange_url1"]; ?>" rel="nofollow" target="_blank" class="go">查看</a></li>
	<li><img src="<?php echo $Tconfig["tubiao2"]; ?>"><div><h3><?php echo $Tconfig["sange_biaoti2"]; ?></h3><span><?php echo $Tconfig["sange_jianjie2"]; ?></span></div><a href="<?php echo $Tconfig["sange_url2"]; ?>" rel="nofollow" target="_blank" class="go">查看</a></li>
	<li><img src="<?php echo $Tconfig["tubiao3"]; ?>"><div><h3><?php echo $Tconfig["sange_biaoti3"]; ?></h3><span><?php echo $Tconfig["sange_jianjie3"]; ?></span></div><a href="<?php echo $Tconfig["sange_url3"]; ?>" class="go" rel="nofollow" target="_blank">查看</a></li>
</ul>
<?php }?>
<!--区域2-->
<div class="region">
	<div class="min-left">
		<div class="new-title">人气榜单</div>
		<ul class="min-show">
			<?php popular();?>			
		</ul>
	</div>
	<div class="min-right">
		<div class="new-title">随机推荐</div>
		<ul class="min-random">
			<?php random();?>
		</ul>
	</div>
</div>
<!--CMS分类-->
<div class="index-cms">
<?php
if ($pageurl == Url::logPage()) {
$db = MySql::getInstance();
global $CACHE;
$sort_cache = $CACHE->readCache('sort');
$sort_id = array_unique(explode(',', trim($Tconfig['cms_id'])));
$out = "";
foreach ($sort_id as $key => $i) {
$out .= "<div class=\"cms-box\"><div class=\"cms-id\"><div class=\"new-title\"><span>".$sort_cache[$i]['sortname']."</span><span class=\"span-right\"><a href='".Url::sort($i)."' title='".$sort_cache[$i]['sortname']."'><i class=\"fa fa-ellipsis-h\"></i></a></span></div><ul class=\"cms-sort\">";
$logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$i}' AND type='blog' AND hide='n' order by date DESC limit 0,8");
while($value = $db->fetch_array($logss)) {;
$date = gmdate('m月d日', $value['date']);
$value['title'] = mb_substr($value['title'], 0, 23, 'utf-8');
$url = Url::log($value['gid']);
$out .= "<li><a href=\"{$url}\" title=\"{$value['title']}\"><i class=\"fa fa-spinner\"></i>{$value['title']}</a><span>{$date}</span></li>";
}
$out .= "</ul></div></div>";
}
$out .= "";
echo $out;
};
?>

</div>
<!--友情链接-->
<div class="links">
	<div class="links_title">
		<div class="links_left">
			<a href="<?php echo $links; ?>" title="友情链接">友情链接</a>
		</div>
	</div>
	<div class="links_div">
		<ul>
		<?php 
		global $CACHE;
		$link_cache = $CACHE->readCache('link');
		$link_cache = array_slice($link_cache,0,12);
		foreach($link_cache as $value): 
		?>
        <li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['link']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/osSlider.js"></script>
<?php include View::getView('footer'); ?>