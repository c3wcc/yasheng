<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="Single-content">
    <div class="Single-body">
		<h1><?php echo $log_title; ?></h1>				
	</div>	
	<div class="Single-box">	
	<?php echo unCompress($log_content,$logid); ?>			
	</div>		
   	<?php if($allow_remark == 'y'): ?>
		<div class="ribbon-comment">			
			<h3>评论列表</h3>		
		    <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			<ol class="comment-list">
			<?php blog_comments($comments,$params); ?>  
			</ol>				
		</div>
	<?php endif;?>
</div>
<?php include View::getView('footer'); ?>