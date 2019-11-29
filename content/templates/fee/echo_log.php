<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="article-focusbox bgimg-fixed" id="focsbox-true" style="background-image: url(https://wallpaper.infinitynewtab.com/wallpaper/<?php echo(rand(10,4050)); ?>.jpg)">
    <header class="article-header">
        <h1 class="article-title"><?php echo $log_title; ?></h1>
        <div class="article-meta">
            <span class="item item-1"><?php echo gmdate('Y-n-j', $date); ?></span>
            <span class="item item-2">阅读(<?php echo $views; ?>)</span> 
         	<span class="item item-3">评论(<?php echo $comnum; ?>)</span>    
			<span class="item item-4">分类：<?php fee_sort($logid); ?></span>
            <?php echo logurl($logid);?>
            <span class="item item-5"><a id="ae_bdcx" rel="external nofollow" target="_blank"></a></span>
            <span class="item item-6"></span>
        </div>
    </header>
			<?php if($Tconfig["post_prevnext_s"]== 1 ){ ?>
	<?php neighbor_log($neighborLog)?>
	<?php }?>	
</section>
<div id="<?php echo get_template_name();?>">
<section class="container">
<div class="content-wrap">
	<div class="leftsd">
		<div id="leftsd" class="left top">
			<?php if($Tconfig["left_sd_s"]== 1 ){ ?>
			<div class="introduce <?php echo $Tconfig["wow"];?>">
				<img data-src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-50 photo" height="50" width="50" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" style="display: inline;">
				<h4>作者：<?php echo feee_author($author); ?></h4>
				<p>
					全网最全的网络资源分享网站
				</p>
				<div class="qrcode">
					<img src="<?php echo $Tconfig["left_qrcode_url_s"];?><?php echo BLOG_URL; ?>"><small>手机扫码查看</small>
				</div>
				<div class="contact">
					<a class="sns-wechat" href="javascript:;" alt="关注“<?php echo $Tconfig["wechat"];?>”" title="关注“<?php echo $Tconfig["wechat"];?>”" data-src="<?php echo $Tconfig["wechat_img"];?>"><i class="fa fa-weixin"></i></a><a target="_blank" nofollow" href="<?php echo $Tconfig["weibo"];?>"><i class="fa fa-weibo"></i></a><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $Tconfig["qq"];?>&site=qq&menu=yes"><i class="fa fa-qq"></i></a>
				</div>
			</div>
			<?php }?>
			<?php if($Tconfig["left_tags_s"]== 1 ){ ?>
			<div class="<?php echo $Tconfig["left_tags_style"];?> <?php echo $Tconfig["wow"];?>">
				<p>
					标签：
				</p>
				<?php blog_tags($logid);?>
			</div>
			<?php }?>
		</div>
	</div>
	<div class="single-content">
		<div class="smhb"><span class="share-haibao"><i class="fa fa-share-alt"></i></span>	
		<p class="shengming"><em>特别声明：</em>文章多为网络转载，资源使用一般不提供任何帮助，特殊资源除外，如有侵权请联系！</p></div>
		<article class="article-content" id="image_container">
		<div class="<?php echo $Tconfig["wow"];?>">
		</div>
		<?php if($excerpt){?>
		<div class="article-zhaiyao "><strong>摘要：</strong><?php echo $excerpt;?></div>
		<?php }else{?>
		<?php }?>
		<?php doAction('log_related',$logid); ?>
						<?php echo ishascomment($log_content,$logid); ?>
						<?php doAction('down_log',$logid); ?>
           <?php $time=strtotime(gmdate('Y-n-j', $date));$now=time();$t=$now-$time;if($t>3600*24*365){?>
          <div class="stetement" style="color: #ad9948;background: #fff4b9 url(https://0d077ef9e74d8.cdn.sohucs.com/rodtIc0_jpg) -1px -1px no-repeat;border: 1px solid #eac946;overflow: hidden;margin: 10px 0;padding: 15px 15px 15px 35px;font-size: 14px;text-indent: 0;">本文最后更新于<?php echo gmdate('Y-n-j', $date); ?>，已超过 1 年没有更新，如果文章内容或图片资源失效，请留言反馈，我们会及时处理，谢谢！</div>
           <?php }?>
		<div class="article-actions">
		<div class="xshare">
				<span class="xshare-title">分享到：</span>
				<a href="javascript:;" class="share-weixin"><i class="fa fa-weixin"></i>
				<span class="share-popover">
				<span class="share-popover-inner" id="weixin-qrcode">
				<img src="<?php echo $Tconfig["left_qrcode_url_s"];?><?php echo BLOG_URL; ?>" modal="zoomImg" data-tag="bdshare">
				</span></span></a>
		<a href="javascript:;" onclick="shareToQzone('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>')" title="分享到QQ空间" class="share-qzone"><i class="fa fa-qzone"></i></a>
		<a href="javascript:;" onclick="shareToWeibo('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>','')" title="分享到微博" class="share-weibo"><i class="fa fa-weibo"></i></a>
		<a href="javascript:;" onclick="shareToQQ('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>')" title="分享给QQ好友" class="share-qq"><i class="fa fa-qq"></i></a>
		</div>
		<div class="post-actions"><?php doAction('ja_related', $logData); ?><a href="javascript:;" class="action action-rewards" data-event="rewards"><i class="fa fa-jpy"></i> 打赏</a> </div>
		</div>
		</article>
		<div class="shuoming <?php echo $Tconfig["wow"];?>">
			<div class="title">
				<span>未经允许不得转载：</span>
			</div>
			<p class="">
				作者:<?php echo feee_author($author); ?>，
			转载或复制请以 
				<a href="<?php echo $value['log_url']; ?>"> 超链接形式</a> 并注明出处 <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>。<br>
			原文地址：
				<a href="<?php echo $value['log_url']; ?>" title="<?php echo $log_title; ?> - <?php echo $blogname; ?>">《<?php echo $log_title; ?>》</a>  发布于<?php echo gmdate('Y-n-j', $date); ?>
			</p>
		</div>
		<div class="article-tags <?php echo $Tconfig["wow"];?>">
			标签：<?php blog_tag($logid);?>
		</div>
		<?php neighbor1_log($neighborLog)?>
		<div class="relates-thumb <?php echo $Tconfig["wow"];?> relates-m">
                     <!--熊掌号开始-->
                       <div style="-padding-left: 17px; -padding-right: 17px;">
                       <script>cambrian.render('tail')</script>
                       </div>
                     <!--熊掌号结束-->
			<h3>相关推荐</h3>
			<ul>
			<?php
					$Log_Model = new Log_Model();
					$randlogs = $Log_Model->getLogsForHome("AND sortid = {$sortid} ORDER BY rand() DESC,date DESC", 1,3);
					foreach($randlogs as $value):
					if(pic_thumb($value['content'])){
                        $imgsrc = pic_thumb($value['content']);
	                }elseif(getThumbnail($value['logid'])){
	                    $imgsrc = getThumbnail($value['logid']);
	                }else{
	                    $imgsrc = TEMPLATE_URL.'static/img/random/'.substr($value['logid'],-1).'.jpg';
	                }
				?>
				<li class=""><a href="<?php echo $value['log_url']; ?>"><img data-thumb="default" src="<?php echo $imgsrc; ?>" class="thumb">
				<h4><?php echo $value['log_title']; ?></h4>
				<time> <?php echo gmdate('Y-n-j', $value['date']); ?></time></a></li>
			<?php endforeach; ?>	
			</ul>
		</div>
		<!-- 评论开始 -->
		<?php if($allow_remark == 'y'): ?>
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			<div id="postcomments" class=" <?php echo $Tconfig["wow"];?>">
				<ol class="commentlist">
				<?php blog_comments($comments); ?>	
				</ol>
			</div>
		<?php endif;?>
		<!-- 评论结束 -->
	</div>
</div>			
<?php include View::getView('side2');?>
</section>
</div>
<?php
 include View::getView('footer');
?>