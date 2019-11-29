<?php 
/* 
Custom:page_contact
Description:留言页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container container-page">
<?php include View::getView('page/page_side');?>
<div class="content">
	<header class="article-header">
	<h1 class="article-title"><?php echo $log_title; ?></h1>
	</header>
	<article class="article-content">
	<?php echo ishascomment($log_content,$logid); ?>
	</article>
	<p>
		&nbsp;
	</p>
	
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
</section>
<?php include View::getView('footer');?>