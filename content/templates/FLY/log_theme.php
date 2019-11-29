<?php 
/**
 * VIP模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<section class="container">
	<div class="content-wrap content-theme">
		<h3><b>VIP专区</b></h3>
		<div class="right"><a href="#">申请加入</a></div>
		<div class="qbztm">全部</div>
		<div class="container">
			<ul class="ztnav"><li class="current-menu-item"><a href="#">博客模板</a></li><li><a href="#">CMS模板</a></li><li><a href="#">图片模板</a></li><li><a href="#">企业模板</a></li></ul>
		</div>
	</div>
	<div class="content-wrap content-theme">
		<div class="row img-row" data-aos="<?php echo $Tconfig['aosxg'];?>">
<?php 
if (!empty($logs)):foreach($logs as $value):
if(pic_thumb($value['content'])){
    $imgsrc = pic_thumb($value['content']);
}elseif(getThumbnail($value['logid'])){
	$imgsrc = getThumbnail($value['logid']);
}else{
	$imgsrc = TEMPLATE_URL.'img/random/'.substr($value['logid'],-1).'.jpg';
}
?>

				<div class="col-sm-4 log-theme">
					<header>
						<h2><?php echo $value['log_title']; ?></h2>
						<h4>适用于企业站、淘宝客和各种展示类型站点</h4>
					</header>
					<div class="theme-thumb">
						<a href="<?php echo $value['log_url']; ?>">
							<img src="<?php echo TEMPLATE_URL; ?>img/lazyload.gif" data-original="<?php echo $imgsrc;?>?param=384y180" class="thumb-theme lazy">
						</a>
					</div>
					<footer>
						<a href="<?php echo $value['log_url']; ?>" class="btn btn-primary">主题详情</a>
						<a href="<?php echo $value['log_url']; ?>" class="btn btn-default">查看演示</a>
					</footer>
				</div>
<?php endforeach;else: ?>
			<article id="post-box">
				<div class="panel">
					<header class="panel-header">
								<h2 class="post-title"><i class="fa fa-info-circle"></i> 友情提示</h2>
						</header>
					<section class="context">
						<p class="tips">你找到的东西压根不存在呀,你可以尝试搜索一下其他关键词！</p>
        			<form action="<?php echo BLOG_URL; ?>" method="get" class="navbar-form navbar-left search-form">
        				<div class="input-group">
        					<input type="text" class="form-control search-texts" name="keyword" placeholder="输入关键词搜索..." >
        					<div class="input-group-btn">
        						<button class="btn btn-default">搜索</button>
        					</div>
        				</div>
        			</form>
					</section>
				</div>
			</article>
			<?php endif;?>
		</div>
		<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
	</div>
</section>
<?php include View::getView('footer');?>