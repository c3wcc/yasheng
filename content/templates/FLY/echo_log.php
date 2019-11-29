<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<section class="container">
	<div class="content-wrap">
		<div id="content" class="content">
			<!-- 内容开始 -->
			<article id="post-box">
					<div class="panel panel-sort">
						<header class="panel-header">
								<div class="post-meta-box">
									<!--面包屑导航开始-->
									<?php mianbao_navi($logid,$log_title);?>
									<!--面包屑导航结束-->
									<div class="meta-top">
						<span class="date-top"><i class="fa fa-clock-o"></i> <time class="pubdate"><?php echo gmdate('Y年n月j日', $date); ?></time></span>
						<span class="comments-top"><i class="fa fa-comments-o"></i> <?php echo $comnum;?>条评论</span>
						<span class="close-sidebar" title="关闭侧边栏"><a href="javascript:;"><i class="fa fa-toggle-off"></i></a></span>
                        <span class="show-sidebar" title="显示侧边栏" style="display:none;"><a href="javascript:;"><i class="fa fa-toggle-on"></i></a></span>
					                </div>
								</div>
								<h2 class="post-title"><span class="fa fa-code"></span> <?php echo $log_title; ?></h2>
								<ul id="mobile-tab-menu" class="no-js-hide">
								<li class="current" data-tab="context">内容</li>
								<li class="" data-tab="related">相关</li>
								</ul>
						</header>
					<section class="context">
					    <?php if($sortid== $Tconfig["dy_id"]){
								if($_GET['ply'] != null){
									$db = Database::getInstance();
									$row = $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE gid =$logid");
									$strarr = explode("\n",$row['spdz']);
									$u = $_GET['ply']-1;
									$urls = explode("*",$strarr[$u]);?>
								<div class="mv4"><h4>正在播放:<?php echo $log_title.'-'.$urls[0]; ?></h4><div>
								<p style="max-width:100%;height:500px;">
								<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width="100%" height="100%" src="//206dy.com/vip.php?url=<?php echo $urls[1];?>&amp;moshi=sd&amp;hd=3">
								</iframe>
								</p>
								<div class="fanhui"><a href="<?php echo $logid;?>.html">返回</a></div>
								<div class="logtop">
									<dl>
										<p>
										<?php 
										$strarr = explode("\n",$row['spdz']);
										$i=1;
										foreach ($strarr as $u){
											$jishu=explode("*",$u);?>
											<a class="spbut" href="<?php echo '?ply='.$i++;?>"><?php echo $jishu[0];?></a>
										<?php }?>
										</p>
									</dl>
								</div>
							<?php }else{
									dyyinfo($logid);
									}
								}else{?>
						<?php doAction('log_related',$logid); ?>
						<?php echo ishascomment($log_content,$logid); ?>
						<?php doAction('down_log',$logid); ?>
						<?php }?>
					</section>
					<div class="share_list shareBox">
						<p>
							<?php doAction('ja_related', $logData); ?>
							<a href="javascript:;" class="sharebtn pay-author"><i class="fa fa-credit-card"></i> 打赏</a>
							<a href="javascript:;" class="sharebtn J_showAllShareBtn"><i class="fa fa-paper-plane-o"></i> 分享</a>
						</p>
						<div class="socialBox">
							<div class="bdsharebuttonbox u-share-container f-usn">
								<ul class="dsye">
									<li class="s-weixin js-share-wx" onclick="shareToWeiXin('https:\/\/api.pjax.cn\/api\/qrcode\/api.php?data=<?php echo Url::log($logid);?>')" title="分享到朋友圈"></li>
									<li class="s-weibo js-share-wb" onclick="shareToWeibo('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>')" title="分享到微博"></li>
									<li class="s-qzone js-share-qz" onclick="shareToQzone('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>','')" title="分享到QQ空间"></li>
									<li class="s-note js-share-note" onclick="shareToQQ('<?php echo Url::log($logid);?>','<?php echo $log_title;?>','<?php echo Url::log($logid);?>')" title="分享给QQ好友"></li>
								</ul>
							</div>
							<div class="panel-reward">
								<ul class="dsye">
									<li class="alipay"><a href="<?php echo TEMPLATE_URL."img/alzf.png";?>" target="_blank" class="highslide"><img alt="打赏" src="<?php echo TEMPLATE_URL."img/alzf.png";?>"></a><b>支付宝扫一扫</b></li>
									<li class="weixinpay"><a href="<?php echo TEMPLATE_URL."img/wxzf.png";?>" target="_blank" class="highslide"><img alt="打赏" src="<?php echo TEMPLATE_URL."img/wxzf.png";?>"></a><b>微信扫一扫</b></li>
									<li class="txpay"><a href="<?php echo TEMPLATE_URL."img/txzf.png";?>" target="_blank" class="highslide"><img alt="打赏" src="<?php echo TEMPLATE_URL."img/txzf.png";?>"></a><b>企鹅扫一扫</b></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</article>
<!-- 内容结束 -->
<!-- 版权开始 -->
<div class="post-copyright panel panel-sort sbclass" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<p class="sidetags"><i class="fa fa-tags"></i> 本文标签：<?php blog_tag($logid);?></p>				
	<p><i class="fa fa-bullhorn"></i> 版权声明：若无特殊注明，本文皆为《<?php blog_author($author); ?>》原创，转载请保留文章出处。</p>
	<p><i class="fa fa-share-alt-square"></i> 本文链接：<?php echo $log_title; ?> - <?php echo Url::log($logid); ?></p>
</div>
<!-- 版权结束 -->
<!-- 相关开始 -->
<div class="span12 related-posts-box mobile-hide" data-aos="<?php echo $Tconfig["aosxg"];?>">
			<div class="panel log_list panel-sort">
				<header class="panel-header">
					<h3 class="log_h3">
						<span class="fa fa-clipboard"></span> 相关文章
					</h3>
				</header>
				<ul class="related-posts row">
				<?php
					$Log_Model = new Log_Model();
					$randlogs = $Log_Model->getLogsForHome("AND sortid = {$sortid} ORDER BY rand() DESC,date DESC", 1,3);
					foreach($randlogs as $value):
					if(pic_thumb($value['content'])){
                        $imgsrc = pic_thumb($value['content']);
	                }elseif(getThumbnail($value['logid'])){
	                    $imgsrc = getThumbnail($value['logid']);
	                }else{
	                    $imgsrc = TEMPLATE_URL.'img/random/'.substr($value['logid'],-1).'.jpg';
	                }
				?>
					<li class="col-sm-4">
						<div class="panel transparent related-posts-panel">
							<a href="<?php echo $value['log_url']; ?>" class="thumbnail-link" rel="bookmark" title="<?php echo $value['log_title']; ?>">
								<img src="<?php echo $imgsrc; ?>" class="thumbnailimg" width="175" height="80" title="<?php echo $value['log_title']; ?>" alt="<?php echo $value['log_title']; ?>">
								<div class="excerpt"><?php echo blog_tool_purecontent(ishascomment($value['content'], 92)); ?></div>
							</a>
						<div class="bottom-box">
							<h4 class="post-title"><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>" rel="bookmark"><?php echo $value['log_title']; ?></a></h4>
							<ul class="post-meta">
							<li class="author">
							<span class="fa fa-github"></span>
							<?php blog_author($value['author']); ?>
							</li>
							<li class="date date-abb">
							<span class="fa fa-clock-o"></span>
							<a href="<?php echo $value['log_url']; ?>" title="发布于<?php echo gmdate('Y-n-j', $value['date']); ?>">
								<time><?php echo gmdate('Y-n-j', $value['date']); ?></time>
							</a>
							</li>
							</ul>
						</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
<!-- 相关结束 -->
<!-- 评论开始 -->
	<?php if($allow_remark == 'y'): ?>
	<article class="span12" id="comments" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<div id="comments2" class="panel-comments panel-sort">
			<div id="respond" class="comment-respond">
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
			<?php blog_comments($comments); ?>	
			<!-- #respond -->
		</div>
	</article>
	<?php endif;?>
<!-- 评论结束 -->
		</div>
	</div>
<div class="modal fade" id="pay_log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">支付订单</h4>
            </div>
            <div class="modal-body" id="payinfo"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" oder='' id="paygidok">确认支付</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on("click","#paygid",function(){
	var gid = $(this).attr("gid");
	$("#pay_log").modal("show");
	$("#payinfo").html("");
	$.ajax({
		url: '<?php echo TEMPLATE_URL; ?>inc/ajax.php?a=paygid',
		type:'post',
		dataType:'json',
		data:{"gid":gid},
		success:function(data){
			if(data.code == 200){
				$("#payinfo").html("<p>订单名称："+data.title+"</p><br><p>订单ID："+data.payid+"</p><br><p>订单时间："+data.time+"</p><br><p>订单金额："+data.money+"</p><br><p>当前余额："+data.mymoney+"</p><br>");
				$("#paygidok").click(function(){
					if(data.mymoney >= data.money){
						$.ajax({
							url: '<?php echo TEMPLATE_URL; ?>inc/ajax.php?a=paygidok',
							type:'post',
							dataType:'json',
							data:{"oderid":data.payid},
							success:function(data){
								if(data.code == 200){
									$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });
								}
								$("#pay_log").modal("hide");
								$(".modal-backdrop").remove();
							}
						});
					}else{
						alert("余额不足");
					}
				});
			}else{
				$("#pay_log").modal("hide");
			}
		}
	});
});
</script>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>


