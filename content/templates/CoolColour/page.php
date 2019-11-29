<?php 
/**
 * 自定义页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div class="container">
<!--左侧开始-->
	<section class="mysection">
	<article >
		<h3 class="arc-title index-title"><?php echo $log_title; ?></h3>
		<div class="post-line bg-color">
			<ul>
				<li><a title="发表于<?php echo gmdate('20y年m月d日',$date); ?>"><i class="el-time"></i><time><?php echo gmdate('20y年m月d日',$date); ?></time></a></li>
				<li><a href="#" title="本文作者"><i class="el-user"></i><?php blog_author($author); ?></a></li>
				<li><a href="#comment-place" title="转到评论"><i class="el-comment"></i><?php if($comnum):?><?php echo $comnum; ?><?php else:?>抢沙发<?php endif;?></a></li>
			</ul>
		</div>
		
		<!--文章正文-->
			<div class="article-content bg-color">
				<div class="article-body">
				<?php echo $log_content; ?>
				</div>
				<!--分享-->
				<div class="article-fx"><a class="fx-btn img-circle" href="javascript:;" class="img-circle">分享</a>
					<div class="bd-fx arc-bdfx">
						<i class="el-remove fx-close"></i>
						<ul class="bdsharebuttonbox">
							<li><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></li>
							<li><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></li>
							<li><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a></li>
							<li><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a></li>
						</ul>
						<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
					</div>
				</div>
				<!--END 分享-->
			<hr>
			</div>
	</article>
<div id="comments">	
<div class="ajax_comment">
<div class="commt_box">
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
<?php blog_comments($comments); ?>
</div>
</div>
</div>


</section>
<!--左侧结束-->

<?php include View::getView('side');?>

</div>
<!--主题框架结束-->

<?php include View::getView('footer');?>