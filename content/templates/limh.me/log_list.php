<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div id="content" role="main">
<?php if(_g('index_hdp')==1):?>
<?php if (str_replace("?_pjax=%23lmhblog","",BLOG_URL . trim(Dispatcher::setPath(), '/')) == BLOG_URL): ?>
<?php echo index_slide(_g('index_slide')); ?>
<?php endif;?>
<?php endif;?>
  <?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
  <article class="post-list" role="article">
    <header class="post-header">
      <h2>
        <?php topflg($value['top']); ?>
        <?php if(((date('Ymd',time())-date('Ymd',$value['date']))<=_g('jqgx'))&&($value['top']=='n')){echo "<span class='new-label'>近期更新</span><i class='new-arrow'></i>";}else if(($value['comnum']>=_g('rm'))&&($value['top']=='n')){echo "<span class='hot-label'>热门</span><i class='hot-arrow'></i>";};?>
        <a rel="bookmark" title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a> </h2>
      <?php if(_g('comnumkg')==1):?>
	  <?php if($value['comnum']>=_g('comnum')): ?>
      <div class="entry-comment-number"> <span class="number"> <a title="查看《<?php echo $value['log_title']; ?>》的<?php echo $value['comnum']; ?>次吐槽" href="<?php echo $value['log_url']; ?>#comments"><?php echo $value['comnum']; ?></a> </span> <span class="corner"></span> </div>
	  <?php endif;?>
      <?php else: ?>
      <?php endif;?>
    </header>
    <div class="post-meta"> <span class="pauthor"><i class="fa fa-user"></i>
      <?php blog_author($value['author']); ?>
      </span> <span class="ptime"><i class="fa fa-calendar"></i> <?php echo mydate($value['date']); ?></span> <span class="pcate"><i class="fa fa-folder-open-o"></i>
      <?php blog_sort($value['logid']); ?>
      </span> <span class="pcomm"><i class="fa fa-eye"></i>
      <?php if($value['views']=="0"){ echo '没'; }else{ echo $value['views']; }?>
      人围观</span><?php if(_g('comnumkg')==2):?><span class="pview"><i class="fa fa-comments"></i>
      <?php if($value['comnum']=="0"){ echo '<a title="抢沙发" href="'.$value['log_url'].'#comments">抢沙发</a>'; }else{ echo  '<a title="查看《'.$value['log_title'].'》的吐槽" href="'.$value['log_url'].'#comments">'.$value['comnum'].'次吐槽</a>'; } ?>
      </span><?php endif;?></div>
    <div class="post-content">
		<?php if(_g('syimg')==1):?>
		<div class="post-thumbnail"> <a href="<?php echo $value['log_url']; ?>">
        <?php
 $thum_src = getThumbnail($value['logid']);
 $imgFileArray = TEMPLATE_URL.'images/random/tb'.rand(1,40).'.jpg';
 if(!empty($thum_src)){ ?>
        <img src="<?php echo $thum_src; ?>" alt="<?php echo $value['log_title']; ?>" title="<?php echo $value['log_title'] ?>" />
        <?php
 }else{
 ?>
        <img src="<?php echo $imgFileArray; ?>" alt="<?php echo $value['log_title']; ?>" title="<?php echo $value['log_title'] ?>" />
        <?php
 }
 ?>
        </a> </div>
		<?php endif;?>
      <div class="post-excerpt"> <?php echo subString(strip_tags(preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '<span>此处内容已隐藏，请进入文章查看。</span>', preg_replace("/\[dplayer(.*)danmu.limh.me\]/Uims", '<span >此处为视频内容，请进入文章查看。</span>', $value['content']))),0,_g('dis_num')); ?> </div>
      <div class="clear"></div>
      <div class="goon"> <a href="<?php echo $value['log_url']; ?>">继续阅读&raquo;</a> </div>
    </div>
  </article>
  <?php endforeach; else: ?>
  <div class="page">
    <article role="article">
      <header class="post-header">
        <h2><i class="fa fa-question-circle"></i> Nothing Found!</h2>
      </header>
      <div class="post-context"> 对不起，你要搜索的“<?php echo urldecode($params[2]);?>”在本站搜不到任何内容，请尝试其他关键词！ </div>
    </article>
  </div>
  <?php endif; ?>
  <div class="pagenavi">
    <?php echo $page_url; ?>
  </div>
</div>
<?php
include View::getView('side');
include View::getView('footer');
?>
