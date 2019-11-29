<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div id="content">
  <div class="page">
    <article role="article">
      <header>
        <h2 class="post-name"><i class="fa fa-user"></i> 相册图库</h2>
      </header>
      <address class="entry-meta">
      <i class="fa fa-home"></i><a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <i class="fa fa-file-text-o"></i>相册图库 &raquo; <i class="fa fa-clock-o"></i>2012年10月18日
      </address>
      <div class="post-context"><?php echo content($log_content); ?></div>
    </article>
  </div>
</div>
<?php include View::getView('footer'); ?>