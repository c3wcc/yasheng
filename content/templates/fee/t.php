<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container container-page">
<?php include View::getView('page/page_side');?>
<div class="content">
	<div class="cleft">
	<ul class="twiter">
		<?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank">
		<img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
		<li class="twiter_list"><section class="comments"><article class="comment"><a class="comment-img" href="#non"><img src="<?php echo $avatar; ?>" width="50" height="50"></a>
		<div class="comment-body">
			<div class="text">
				<p>
					<?php echo $val['t'].'<br/>'.$img;?>
				</p>
				<p class="twiter_info">
					<i class="fa fa-user"></i><span class="twiter_author"><?php echo $author; ?>
					</span><time class="twiter_time"><i class="fa fa-clock-o"></i><?php echo $val['date'];?>
					</time>
				</p>
			</div>
		</div>
		</article></section></li>
		<?php endforeach;?>
	</ul>

		<div class="pagenav">
			<?php echo $pageurl;?>
		</div>

</div>	
	<!-- 评论开始 -->
		<?php if($allow_remark == 'y'): ?>
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			<?php blog_comments($comments); ?>	
		<?php endif;?>
		<!-- 评论结束 -->
</div>
</section>
<?php include View::getView('footer');?>