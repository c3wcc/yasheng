<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<style type="text/css">
#content {
	width: 100%;
	border-right: 0px
}
</style>
<div id="content">
  <div class="page">
    <article role="article">
      <header>
        <h2 class="post-name"><i class="fa fa-link"></i> <?php echo $log_title; ?></h2>
      </header>
      <address class="entry-meta">
      <i class="fa fa-home"></i><a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <i class="fa fa-file-text-o"></i><?php echo $log_title; ?> &raquo; <i class="fa fa-clock-o"></i>
      <?php mydate($date) ?>
      </address>
      <?php if($log_title=='友链'||$log_title=='友情链接'||$log_title=='Links'): ?>
      <div class="post-context"><?php echo content($log_content,$logid); ?></div>
      <?php include View::getView('function/page-links'); ?>
      <?php else: ?>
      <div class="post-context"><?php echo content($log_content,$logid); ?></div>
      <?php endif;?>
    </article>
  </div>
</div>
<?php include View::getView('footer'); ?>
