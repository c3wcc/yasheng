<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<style>
    #comments {
    font-size: 16px;
    padding: 0;}
    .comment .comment-body{margin: 0;}
}
</style>
<div id="catui-content">
        <div class="catui-container">
            <div class="catui-primary detail diary">
                <div id="comments" class="catui-item">
                    <div class="detail-header">
					<?php
if($imgsrc = !empty($img[1])){
		 $imgsrc = $img[1][0];}else{ 
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content ,$img);
			if($imgsrc = !empty($img[1])){ $imgsrc = $img[1][0];  }else{
				$imgsrc =getrandomim();	
			}
	}
	?>
                        <div class="detail-background" style="background-image:url(<?php echo $imgsrc;?>);"></div>
                        <div class="detail-title"><?php topflg($top); ?><?php echo $log_title; ?></div>
                        <div class="detail-intro">
                            <ul class="detail-intro-meta">
                                <li><?php echo gmdate('Y-n-j', $date); ?>日</li>
                                <li><?php echo $comnum; ?>评论</li>
                                <li><?php echo $views; ?>围观</li>
                                <li>作者:<?php echo blog_author($author); ?></li>
                            </ul>
                        </div>
                    </div>
               <div class="detail-border">
				        <div></div>
				        <div></div>
				        <div></div>
				        <div></div>
				        <div></div>
				        <div></div>
				        <div></div>
				        <div></div>
		        	</div>
<div class="comment">
    <ol class="comment-list">
    <?php foreach ($tws as $val) : $author = $user_cache[$val['author']]['name'];$avatar = empty($user_cache[$val['author']]['avatar']) ? BLOG_URL . 'admin/views/images/avatar.jpg' : BLOG_URL . $user_cache[$val['author']]['avatar'];$tid = (int)$val['id'];$img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img src="'.BLOG_URL.$val['img'].'"></a>'; ?>
    <li id="li-comment-2481" class="comment-body comment-parent comment-odd">
    <div id="comment-2481">
                 <div class="comment-view">
            <div class="comment-header"><img class="avatar" src="<?php echo $avatar; ?>"></div>
            <div class="comment-content">
                <div class="comment-meta">
                    <span class="comment-author mdui-ripple">
                    <a rel="external nofollow" tooltip="<?php echo $author; ?>"><?php echo $author; ?></a>
                    </span>
                    <span class="comment-time mdui-ripple"><?php echo $val['date'];?></span>
                </div>
                <div class="comment-text"><?php echo $val['t'].'<br/>'.$img; ?></div>
            </div>
        </div>
    </div>
    </li>
    <?php endforeach;?>
</ol>
</div><!-- .comment -->
                </div><!-- #comments -->
               
            </div><!-- .catui-primary -->
            <?php
 include View::getView('side');
?>
        </div><!-- .catui-container -->
    </div>
    <?php
 include View::getView('footer');
?>