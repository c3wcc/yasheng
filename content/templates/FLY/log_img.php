<?php 
/**
 * 图片列表模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<section class="container">
	<div class="content-wrap content-img">
		<div class="row img-row">
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
			<div class="col-sm-3 log-img" data-aos="<?php echo $Tconfig['aosxg'];?>">
				<div class="item-img">
					<div class="thumb">
						<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>">
						<img alt="<?php echo $value['log_title']; ?>" class="lazy" src="<?php echo TEMPLATE_URL; ?>img/lazyload.gif" data-original="<?php echo $imgsrc;?>?param=250y150"></a>
					</div>
				<div class="meta">
					<div class="title"><h2><a href="<?php echo $value['log_url']; ?>" rel="bookmark" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h2></div>
						<div class="extra"><i class="fa fa-bookmark"></i>
						<a href="<?php echo $value['log_url']; ?>" rel="category tag"><?php blog_sort($value['logid']); ?></a>
						<span><?php echo $value['views'];?><i class="fa fa-fire"></i></span>
					</div>			
				</div>
					<div class="data">
					<time class="time"><?php echo gmdate('Y-n-j', $value['date']); ?></time>
					<span class="comment-num">
						<a href="<?php echo $value['log_url']; ?>#respond" class="comments-link"><i class="fa fa-comment"></i><?php echo $value['comnum'];?></a>
					</span>
					<span class="heart-num"><?php doAction('ja_praise', $value['logid']); ?></span>
					</div>
				</div>
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