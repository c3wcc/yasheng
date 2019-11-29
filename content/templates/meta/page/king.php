<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="Single-content">
	<div class="Single-body">
		<h1><?php echo $log_title; ?>
		</h1>
	</div>
	<div class="Single-box">
		<div class="Single-king">
			<div class="king-title">登上榜单，让您成为众多网友关注的焦点！</div>
			<div class="king-content">
			<ul>
			<?php echo guest(51); ?>
			</ul>				
			</div>
		</div>
	</div>
</div>

<?php include View::getView('footer'); ?>