<?php
/**
 * 列表模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if($pageurl == Url::logPage()){include View::getView('index');exit;}
if(isset($author)){include View::getView('user/author');exit;}
?>
<?php if($sortName){?><div class="content-title"><a href="<?php echo BLOG_URL; ?>"  title="网站首页">网站首页</a><i class="fa fa-angle-right"></i><?php echo $sortName;?></div>
<?php }elseif($keyword ||$tag ||$record ){?><div class="content-title"><a href="<?php echo BLOG_URL; ?>"  title="网站首页">网站首页</a><i class="fa fa-angle-right"></i>关键词：<b style="color: #F44336;"><?php echo urldecode($params[2]);?></b></div><?php }else{?><?php }?>		
<div class="new-list">	
<!--广告位2-->
<?php if($Tconfig["add_gg"]== 1 ){?>
<div class="add-gg">
	<a href="<?php echo $Tconfig["add_url2"]; ?>" target="_blank" rel="nofollow" title=""><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $Tconfig["add_tu2"]; ?>" alt="" class="lazy"></a>
</div>
<?php }?>
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
	 <div class="list-word"><h1>没有您要找的文章！</h1><p>可以尝试使搜索功能，查找您喜欢的文章！</p></div>
	 <?php endif; ?>
	<div id="pagenavi">
		<?php echo $page_url;?>
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>