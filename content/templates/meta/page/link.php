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
		<div class="Single-link">
		<?php 
			global $CACHE;
			$link_cache = $CACHE->readCache('link');			
			foreach($link_cache as $value): 			 			
		?>		
			<a href="<?php echo TEMPLATE_URL; ?>inc/go.php/?url=<?php echo base64_encode($value['url']); ?>" target="_blank" title="<?php echo $value['link']; ?>">
				<div class="Single-link-box">
					<img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo TEMPLATE_URL; ?>inc/api.php?qq=<?php if(empty($value["des"])){echo '暂无';}else{echo $value["des"];}?>"  class="lazy"  alt="">
					<p><?php echo $value['link']; ?></p>
				</div>
			</a>
		 <?php endforeach;?>	
		</div>
	</div>
</div>
<?php include View::getView('footer'); ?>