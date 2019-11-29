<?php
/**
 * 列表模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if($pageurl == Url::logPage()){include View::getView('index');exit;}
?>
<div class="new-list">
	<div class="h1-title"><?php if($sortName){?><?php echo $sortName;?>
	<?php }elseif($keyword ||$tag ||$record ){?>关键词：<b style="color: #F44336;"><?php echo urldecode($params[2]);?></b>
	<?php }else{?>
	<?php }?>
	</div>
	<?php if (!empty($logs)): foreach ($logs as $value): ?>
	<article class="list-content">
	<ul class="list-ul">
		<li>
		<a href="<?php echo $value['log_url']; ?>" target="_blank" class="list-img" title="<?php echo $value['log_title']; ?>"><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php get_imgsrc($value['content']);?>" alt="<?php echo $value['log_title']; ?>" class="lazy"></a>		
		<div class="list-box">		
			<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a><?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?></h2>			
			<div class="list-span">
				<span class="list-data">时间：<?php echo gmdate('n月j日', $value['date']); ?></span>
				<span>作者：<?php blog_author($value['author']); ?></span>
				<span> 围观：<?php echo $value['views']; ?></span>
				<span> 分类：<?php blog_sort($value['logid']); ?></span>
			</div>			
			<div class="list-txt"><?php echo $logdes = geshihua($value['content'], 99); ?></div>
			<div class="list-btn"><a href="<?php echo $value['log_url']; ?>" target="_blank" title="">立即查看</a></div>
		</div>		
		</li>		
	</ul>
	</article>
	 <?php endforeach; else: ?>
	 <p style="text-align: center;font-size: 18px;margin-top: 50px;height: 100px; color: #E91E63;">抱歉，没有符合您查询条件的结果。</p>
	 <?php endif; ?>
	<div id="pagenavi">
		<?php echo $page_url;?>
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>