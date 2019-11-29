<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div id="catui-content">
        <div class="catui-container">
            <div class="catui-primary detail">
                <div class="catui-item">
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
                    <article class="detail-article">
                  <p>
                    <?php echo  reply_view($log_content,$logid);//文章回复可见?>
                      <?php pages_links(); ?>
                   </p>
                    </article>
                </div><!-- .catui-item -->
        <div id="comments" class="catui-item">
			<div class="article_post_comment" id="comment-place">
				<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
			<?php 
				echo '<h3 class="comment-header">网友评论<b>（'.$comnum.'）</b></h3>';
				echo '<ol class="comment-list">';
			?>
			<?php blog_comments($comments,$comnum); ?>
			<?php
				echo '</div>';
			?>
        </div>

<?php
 include View::getView('side');
?>
        </div><!-- .catui-container -->
    </div>
</div><!-- .catui-primary -->

<?php
 include View::getView('footer');
?>
