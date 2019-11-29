<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div id="content">
  <div class="page">
    <article role="article">
      <header>
        <h2 class="post-name"><i class="fa fa-paper-plane"></i> <?php echo $log_title; ?></h2>
      </header>
      <address class="entry-meta">
      <i class="fa fa-home"></i><a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <i class="fa fa-file-text-o"></i><?php echo $log_title; ?> &raquo; <i class="fa fa-clock-o"></i>
      <?php mydate($date) ?>
      </address>
      <div class="post-context"><?php echo content($log_content); ?></div>
    </article>
    <div id="comments">
      <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
      <?php if(empty($comnum)){ echo "";}else{echo"<h3><i class='fa fa-comments-o'></i> 已有";echo $comnum;echo"条吐槽</h3>";} ?>
      <?php blog_comments($comments,$params); ?>
    </div>
  </div>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>
