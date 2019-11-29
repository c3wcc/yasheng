<?php 
/**
 * 音乐页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div id="content" id="content" class="content container-tw" data-aos="<?php echo $Tconfig['aosxg'];?>">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-music"></i> 音乐<?php echo $log_title; ?></h1>
        </header>
		<section class="context">
			<?php echo ishascomment($log_content,$logid); ?>
		</section>
    </div>
  </div>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>