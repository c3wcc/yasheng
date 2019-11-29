<?php
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){include View::getView('setting');exit();}
if(isset($_GET["meta"])){include View::getView('user/index');exit;}
?>
<?php if($add_gg== 1 ){?>
<!--广告位-->
<div class="add-gg">
	<a href="<?php echo $add_url1;?>" target="_blank" rel="nofollow" title=""><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $add_tu1;?>" alt="" class="lazy"></a>
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
				<font <?php if(((date('Ymd',time())-date('Ymd',$value['date']))< 1)){?>class="new-time"<?php }?>><?php echo gmdate('n月j日', $value['date']); ?></font>
				</li>	
			<?php  endforeach; else: ?>
			<?php endif;?>		
			</ul>		
		</div>		
		<div class="new-page"></div>
	</div>
	</div>
<div class="indexnews-ad">
    <ul class="indexnewss-ad layui-clear">
        <li>
            <img src="style/vv0029/images/tb.jpg" alt="淘宝优惠券">
            <div>
                      <h3>淘宝优惠券</h3>
				 <span>定期更新剁手优惠券</span>
            </div>
            <a class="go" href="http://tbk.ruoze.cc" target="_blank">去看看</a>
        </li>
        <li>
            <img src="style/vv0029/images/tm.jpg" alt="天猫优惠券">
            <div>
			      <h3>天猫优惠券</h3>
                <span>大额券限时限量领取</span>
            </div>
            <a class="go" href="http://tbk.ruoze.cc" target="_blank">去看看</a>
        </li>
        <li>
            <img src="style/vv0029/images/pdd.jpg" alt="拼多多优惠券">
            <div>
			       <h3>拼多多优惠券</h3>
                 <span>独家首发拼团优惠券</span>
            </div>
            <a class="go" href="http://tbk.ruoze.cc" target="_blank">去看看</a>
        </li>
</div>

<!--CMS分类-->
<div class="index-cms">
<?php
if ($pageurl == Url::logPage()) {
$db = MySql::getInstance();
global $CACHE;
$sort_cache = $CACHE->readCache('sort');
$sort_id = array_unique(explode(',', trim($cms_id)));
$out = "";
foreach ($sort_id as $key => $i) {
$out .= "<div class=\"cms-box\"><div class=\"cms-id\"><div class=\"new-title\"><a href='".Url::sort($i)."' title='".$sort_cache[$i]['sortname']."'>".$sort_cache[$i]['sortname']."</a></div><ul class=\"cms-sort\">";
$logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$i}' AND type='blog' AND hide='n' order by date DESC limit 0,8");
while($trow = $db->fetch_array($logss)) {;
$date = gmdate('m月d日', $trow['date']);
$trow['title'] = mb_substr($trow['title'], 0, 23, 'utf-8');
$url = Url::log($trow['gid']);
$out .= "<li><a href=\"{$url}\" title=\"{$trow['title']}\">{$trow['title']}</a><span>{$date}</span></li>";
}
$out .= "</ul></div></div>";
}
$out .= "";
echo $out;
};
?>
</div>
<div class="indexnews-ad">
    <ul class="indexnewss-ad layui-clear">
        <li>
            <img src="style/vv0029/images/tubiao1.png" alt="淘宝优惠券">
            <div>
                      <h3>欢迎加入QQ群</h3>
				 <span>全网最牛逼的QQ群</span>
            </div>
            <a class="go" href="https://jq.qq.com/?_wv=1027&k=5grybfO" target="_blank">去看看</a>
        </li>
        <li>
            <img src="style/vv0029/images/tubiao1.png" alt="天猫优惠券">
            <div>
			      <h3>气质导航网</h3>
                <span>学习技术从这里开始</span>
            </div>
            <a class="go" href="http://www.xr101.cn/" target="_blank">去看看</a>
        </li>
        <li>
            <img src="style/vv0029/images/tubiao1.png" alt="拼多多优惠券">
            <div>
			       <h3>气质代刷网</h3>
                 <span>你需要的这里都有</span>
            </div>
            <a class="go" href="http://www.hisoer.cn/" target="_blank">去看看</a>
		</div>
		</li>
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