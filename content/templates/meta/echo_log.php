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
		    <span id="date-block">时间:<?php echo gmdate('Y-m-d', $date); ?></span>
			<span id="date-block">分类:<?php blog_sort($logid); ?></span>			
			<span>评论:<?php echo $comnum; ?></span>			
			<span>阅读:<?php echo $views; ?></span>
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
	<?php if($Tconfig["popular"]== 1 ){?>	
	<div class="article-recommend">			
		<h3>热门推荐</h3>
		<?php related_logs($logData);?>																
	</div>
	<?php }?>
	<!--广告位3-->
	<?php if($Tconfig["add_gg"]== 1 ){?>	
	<div class="add-gg">
	<a href="<?php echo $Tconfig["add_url3"]; ?>" target="_blank" rel="nofollow" title=""><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $Tconfig["add_tu3"]; ?>" alt="" class="lazy"></a>
	</div>
	<?php }?>	
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