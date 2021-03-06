<?php 
/* 
Custom:page
Description:默认页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div id="content" class="content container-tw" data-aos="<?php echo $Tconfig['aosxg'];?>">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-file-text-o"></i> <?php echo $log_title; ?></h1>
        </header>
		<section class="context">
			<?php echo ishascomment($log_content,$logid); ?>
		</section>
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