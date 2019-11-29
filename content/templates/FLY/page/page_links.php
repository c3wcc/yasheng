<?php 
/* 
Custom:page_links
Description:友情链接 
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div id="content" class="content container-tw" data-aos="<?php echo $Tconfig['aosxg'];?>">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-link"></i> <?php echo $log_title; ?></h1>
        </header>
		<section class="context">
			<?php echo ishascomment($log_content,$logid); ?>
			<?php doAction('flink_echo'); ?>
			<div class="row blogroll">
			<?php if (Option::EMLOG_VERSION == '6.0.1'){?>
			<?php sortLinks();?>
			<?php }else{ ?>
			<?php 
			global $CACHE;
			$link_cache = $CACHE->readCache('link');
			foreach($link_cache as $value): ?>
				<div class="col-md-2 col-sm-4 col-xs-6 linkli"><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><img alt="link" src="<?php echo TEMPLATE_URL; ?>inc/ico.php?url=<?php $icourl = preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $value['url']);echo $icourl;?>"><?php echo $value['link']; ?></a></div>
				<?php endforeach; ?>
			<?php } ?>
			</div>
		</section>
      <?php doAction('link_web_echo'); ?>
	<!-- 评论开始 -->
	<?php if($allow_remark == 'y'): ?>
	<article class="span12" id="comments">
	<div id="comments2" class="panel-comments">
			<div id="respond" class="comment-respond">
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
			<?php blog_comments($comments); ?>	
			<!-- #respond -->
		</div>
	</article>
	<?php endif;?>
	<!-- 评论结束 -->
    </div>
  </div>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>