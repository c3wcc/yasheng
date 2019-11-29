<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--文章内页-->
<div class="article-content">
	<div class="article-body">
		<h1><?php echo $log_title; ?></h1>
		<div class="article-meta">
		    <span id="date-block"><i class="fa fa-clock-o"></i><?php echo gmdate('Y年n月j日', $date); ?></span>
			<span><i class="fa fa-list"></i><?php blog_sort($logid); ?></span>			
			<span><i class="fa fa-comment"></i><?php echo $comnum; ?></span>			
			<span><i class="fa fa-fire fa-fw"></i><?php echo $views; ?></span>
		</div>
		<div class="article-about">
		<?php neighbor_log($neighborLog); ?>
		</div>
	</div>
	<div class="article-box">
	<div class="article-txt">
	<?php echo unCompress($log_content,$logid); ?>
	<?php doAction('down_log',$logid); ?>
	</div>	
	<div class="article-return">
	<div class="article-copyright">
	<div class="article-tag">
		<?php blog_tag($logid); ?>	
	</div>
	<span><i class="fa fa-share-alt-square"></i>未经允许不得转载：<a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>"><?php echo $blogname; ?></a> » <a href="<?php echo Url::log($logid); ?>" title="<?php echo $log_title; ?>"><?php echo $log_title; ?></a></span>
	</div>
	<div class="article-love">
		<a title="点赞" class="slzanpd" data-slzanpd="<?php echo $logData['logid'];?>"><i class="fa fa-heart-o"></i>点赞:<span><?php echo(isset($logData['slzan'])?$logData['slzan']:getnum($logData['logid']));?></span></a>
	</div>
	</div>	
	</div>	
	<div class="article-author" >
	<?php index_author($author); ?>		
	</div>
	<div class="article-recommend">			
		<h3>热门推荐</h3>
		<?php related_logs($logData);?>																
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

<?php
 include View::getView('side');
 include View::getView('footer');
?>