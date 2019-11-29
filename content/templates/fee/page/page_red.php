<?php 
/* 
Custom:page_red
Description:读者墙
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container container-page">
	<?php include View::getView('page/page_side');?>
	<div class="content">
		<header class="article-header">
		<h1 class="article-title"><?php echo $log_title; ?></h1>
		</header>
		<article class="article-content">
          <?php echo $log_content; ?>
		</article>
		<div class="readers">
			<?php echo guest(111); ?>
		</div>
	</div>
</div>
<?php include View::getView('footer');?>