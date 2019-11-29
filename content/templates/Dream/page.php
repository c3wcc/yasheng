<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div id="content">
        <div class="container">
            <div class="primary detail">
                <div class="item">
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
                        
                        <div class="detail-intro">
                            <ul class="detail-intro-meta">
                                



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

 <article class="article-content">
<?php echo $log_content; ?>
 </article> 

	<div class="article_related"><?php doAction('log_related', $logData); ?></div>
			<div class="article_post_comment" id="comment-place">
				<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
			<a name="comments"></a>
			<?php 
			if(isShowComment($comnum)) {
				echo '<h3 class="comment-header">网友评论<b>（'.$comnum.'）</b></h3>';
				echo '<div class="article_comment_list">';}
			?>
			<?php blog_comments($comments,$comnum); ?>
			<?php
			if(isShowComment($comnum)) {
				echo '</div>';}
			?>
</div> </div></div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>
