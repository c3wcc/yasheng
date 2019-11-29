<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div id="content" role="main">
  <div class="page">
    <article role="article">
      <header>
        <h2 class="post-name"><i class="fa fa-twitter"></i> 微言碎语</h2>
      </header>
      <address class="entry-meta">
      <a href="<?php echo BLOG_URL;?>" title="返回首页"><i class="fa fa-home"></i>首页</a> &raquo; <i class="fa fa-file-text-o"></i>微言碎语 &raquo; <i class="fa fa-clock-o"></i>2012年5月18日傍晚
      </address>
      <div class="tw">
        <div class="plus"></div>
        <div class="plus2"></div>
        <ul class="archives-monthlisting">
          <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
          <li>
            <em1></em1>
            <div class="avatar" ><?php echo $val['date'];?></div>
            <div class="tw-content"><em></em><?php echo $val['t'].'<br/>'.$img;?>
              <div class="status-wall-meta"><span><?php echo $val['date'];?></span></div>
            </div>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
    </article>
    <div class="pagenavi"><?php echo $pageurl;?></div>
  </div>
  <!--end #tw--> 
</div>
<!--end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>
