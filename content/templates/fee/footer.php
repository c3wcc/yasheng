<?php include View::getView('inc/ajax_login');?>
<footer class="footer">
	<div class="container">
	<?php if (blog_tool_ishome()) {?>
					<div class="fcode">
                      <h6>友情链接:&nbsp;&nbsp;
                        <?php 
				global $CACHE;
				$link_cache = $CACHE->readCache('link');
				foreach($link_cache as $value): 
				if (Option::EMLOG_VERSION == '1.0'){
				if ($value['linksortid'] != 1){continue;}} ?>
                        <a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a>&nbsp;&nbsp;
                        <?php endforeach; ?>
                      </h6>
</div>   
			<?php }?>
						<p>&copy; 2019 <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?>  <a class="fed-font-xiv" href="https://www.yashang.ink/sitemap.xml" target="_blank">RSS订阅</a>  </a> &nbsp; <a href="http://beian.miit.gov.cn" target="_blank"><?php echo $icp; ?></a> <?php echo $footer_info; ?></p>
			</div>      
</footer>
<?php if($logid && $type=='blog' ){?>
<div class="rewards-popover-mask" data-event="rewards-close"></div>
	<div class="rewards-popover">
		<h3>觉得文章有用就打赏一下文章作者</h3>
				<div class="rewards-popover-item">
			<h4>支付宝扫一扫打赏</h4>
			<img src="<?php echo TEMPLATE_URL."static/img/alzf.png";?>">
		</div>
						<div class="rewards-popover-item">
			<h4>微信扫一扫打赏</h4>
			<img src="<?php echo TEMPLATE_URL."static/img/wxzf.png";?>">
		</div>
				<span class="rewards-popover-close" data-event="rewards-close"><i class="fa fa-close"></i></span>
	</div>
<?php }?>
<!---底部均为重要文件，请勿修改，如修改损坏本站概不负责--->
<script>
window.jsui={
	www: '<?php echo BLOG_URL; ?>',
	uri: '<?php echo TEMPLATE_URL; ?>',
	ver: '<?php echo Theme_Version;?>',
	roll: [],
	ajaxpager: '<?php echo $Tconfig["ajaxpager"];?>',
	get_wow: '<?php echo $Tconfig["aos"];?>',
<?php if($logid && $type=='blog' ){?>
	left_sd: '1',
<?php }else{?>
	left_sd: '0',
<?php }?>
	qq_id: '<?php if($Tconfig["fqq_s"]== 1 ){ ?><?php echo $Tconfig["fqq_id"];?><?php }?>',
	qq_tip: 'QQ咨询',
	wintip_s: '<?php echo $Tconfig["rtc"];?>',
	collapse_title: '<?php echo $Tconfig["pse_title"];?>',
	wintip_m: '<?php echo $Tconfig["wintip_m"];?>',
    bing_img: 'https://api.17uw.cn/api/bg/sinaimg.php',
	notices_s:  '<?php echo $Tconfig["notices_s"];?>',
	notices_title:  '<?php echo $Tconfig["notices_title"];?>',
	notices_content:  '<?php echo $Tconfig["notices_content"];?>'
};
</script>



<?php if($logid && $type=='blog' ){?>
<script>
  (function() {

	function setClickHandler(id, fn) {
	  document.getElementById(id).onclick = fn;
	}

	setClickHandler('image_container', function(e) {
	  e.target.tagName === 'IMG' && BigPicture({
		el: e.target,
		imgSrc: e.target.src.replace('_thumb', '')
	  });
	});

  })();
</script>
<?php }?>
<?php
if($Tconfig["rtc"]== 1 ){
?>
<div class="wintips">
      <a href="<?php echo $Tconfig["rtcurl"];?>" target="_blank" class="wintips-thumb">
        <img src="<?php echo $Tconfig["rtcimg"];?>"> </a>
      <div class="pp-intro-bar"><?php echo $Tconfig["rtcrd"];?>        <span class="wintips-close">
          <i class="fa fa-times-circle-o"></i>
        </span>
      </div>
      <div class="wintips-content">
        <h2><?php echo $Tconfig["rtcbt"];?></h2>
        <p><?php echo $Tconfig["rtccn"];?></p>
        <a href="<?php echo $Tconfig["rtcurl"];?>" target="_blank" class="btn btn-primary btn-wintips">
	<?php echo $Tconfig["rtcan"];?></a>
      </div>
    </div>
<?php }?>
<?php if($Tconfig['bg_mbl']== 1 ){echo '<div class="bg-fixed"></div>';} ?>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/sign.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='//lib.baomitu.com/wow/1.0.1/wow.min.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/Lightbox.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/libs/jquery.cookie.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/commentImg.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/libs/bootstrap.min.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>static/js/loader.js?ver=<?php echo Option::EMLOG_VERSION; ?>'></script>
<script>
jQuery(function(){
		$("a.marginLeft").hover(function(){
			$(this).stop().animate({marginLeft:"12px"},100);
		},function(){
			$(this).stop().animate({marginLeft:"0px"},100);
		});
});
</script>

<style type="text/css">.nav{display:none;}@media screen and (min-width:767px){#mobile-footer{display:none}}
#mobile-footer{height:60px;background:#fafafa;position:fixed;bottom:0;left:0;border-top:0;width:100%;z-index:9999999}
#mobile-menu{display:block}
#mobile-menu:after{content:'';display:block;height:0;clear:both}
#mobile-menu>li{width:20%;float:left;border-top:1px solid #e6e6eb;height:100%}
#mobile-menu>li>a:hover{color:#000;}
#mobile-menu>li>.active{color:#000;}
#mobile-menu>li>a{text-align:center;color:#777;display:block;line-height:12px;height:100%}
#mobile-menu>li>a>span{font-size:20px;display:block;line-height:30px}</style>



<div id="mobile-footer">
    <ul id="mobile-menu">
        <li> <a href="https://www.yashang.ink/"> <span class="fa fa-home"></span> 首页 </a></li>
       
        <li> <a href="/links"> <span class="fa fa-chain"></span> 友链 </a></li>

<li> <a href="javascript:;" class="search-show active"> <span class="fa fa-search"> </span> 搜索 </a></li>

        <li> <a href="/post-46.html"> <span class="fa fa-user-plus"></span> 关于 </a></li>
        <li> <a href="/guestbook.html"> <span class="fa fa-user"></span> 留言 </a></li>
    </ul>
</div>

<?php doAction('index_footer');?>
</body>
</html>