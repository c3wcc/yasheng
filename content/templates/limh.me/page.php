<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div id="content">
  <div class="page">
    <article role="article">
      <header>
        <h2 class="post-name"><?php echo $log_title; ?></h2>
      </header>
      <?php if($log_title=='吐槽板'||$log_title=='留言'||$log_title=='Guestbook'):?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <ul class="readers-list">
        <?php include View::getView('function/page-guestbook'); ?>
      </ul>
      <?php elseif($log_title=='归档'||$log_title=='文章归档'||$log_title=='Archiver'||$log_title=='Archivers'): ?>
      <?php include View::getView('function/page-archives'); ?>
      <?php elseif($log_title=='友链'||$log_title=='友情链接'||$log_title=='Links'): ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <?php include View::getView('function/page-links'); ?>
      <?php elseif($log_title=='标签'||$log_title=='标签云集'||$log_title=='标签云'||$log_title=='Tags'): ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <?php include View::getView('function/page-tags'); ?>
      <?php elseif($log_title=='图片墙'||$log_title=='图片集'||$log_title=='Images'): ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <ul class="imageswall">
        <?php include View::getView('function/page-images'); ?>
      </ul>
      <?php elseif($log_title=='状态墙'||$log_title=='状态'||$log_title=='说说'||$log_title=='说说墙'||$log_title=='Twitter'): ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <?php include View::getView('function/page-t'); ?>
      <?php elseif($log_title=='注册'||$log_title=='立即注册'||$log_title=='用户注册'||$log_title=='Register'): ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <?php include View::getView('function/page-reg'); ?>
      <?php else: ?>
      <div class="post-context"><?php echo content($log_content); ?></div>
      <?php endif;?>
    </article>
    <div id="comments">
      <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
      <?php if(empty($comnum)){ echo "";}else{echo"<h3><i class='fa fa-comments-o'></i>已有";echo $comnum;echo"条吐槽</h3>";} ?>
      <?php blog_comments($comments,$params); ?>
    </div>
  </div>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>
