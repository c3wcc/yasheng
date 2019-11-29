<?php 
/* 
Custom:page_links
Description:友情链接 
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container container-page">
	<?php include View::getView('page/page_side');?>
	<div class="content">
		<header class="article-header">
		<h1 class="article-title"><?php echo $log_title; ?></h1>
		</header>
		<article class="article-content">
		<?php echo $log_content; ?>
		</article>
		<ul class="plinks">
			<li id="linkcat-31" class="linkcat">
			<h2>友情链接</h2>
			<ul class="xoxo blogroll">
			<?php 
				global $CACHE;
				$link_cache = $CACHE->readCache('link');
				foreach($link_cache as $value): 
				if (Option::EMLOG_VERSION == '1.0'){
				if ($value['linksortid'] != 1){continue;}} ?>
				<li><a title="<?php echo $value['des']; ?>" href="<?php echo $value['url']; ?>" target="_blank"><img src="<?php echo TEMPLATE_URL; ?>inc/ico.php?url=<?php $icourl = preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $value['url']);echo $icourl;?>" alt="links"><?php echo $value['link']; ?></a></li>
			<?php endforeach; ?>
			</ul>
			</li>
		</ul>
		
		<!-- 评论开始 -->
		<?php if($allow_remark == 'y'): ?>
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			<div id="postcomments" class=" <?php echo $Tconfig["wow"];?>">
				<ol class="commentlist">
				<?php blog_comments($comments); ?>	
				</ol>
			</div>	
		<?php endif;?>
		<!-- 评论结束 -->
	</div>
</div>
<?php include View::getView('footer');?>