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
        <h2 class="post-name"><i class="fa fa-users"></i> <?php echo $log_title; ?></h2>
      </header>
      <address class="entry-meta">
      <i class="fa fa-home"></i><a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <i class="fa fa-file-text-o"></i><?php echo $log_title; ?> &raquo; <i class="fa fa-clock-o"></i>
      <?php mydate($date) ?>
      </address>
      <div class="post-context"><?php echo content($log_content); ?></div>
    </article>
  </div>
</div>
<?php include View::getView('footer'); ?>
