<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php include View::getView('inc/ajax_login');?>
<?php if (blog_tool_ishome()) {?>
<div class="container footer_">
	<div class="links_  mbl" data-aos="<?php echo $Tconfig['aosxg'];?>">
		<div class="links_bt">
			<div class="links_bt_l">
				<a href="javascript:;">友情链接</a>
			</div>
			<div class="links_bt_r">
				<a href="<?php echo BLOG_URL;?>links.html">更多</a>
			</div>
		</div>
		<div class="links_lb">
			<ul>
				<?php 
				global $CACHE;
				$link_cache = $CACHE->readCache('link');
				foreach($link_cache as $value): 
				if (Option::EMLOG_VERSION == '6.0.1'){
				if ($value['linksortid'] != 1){continue;}} ?>
					<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?>
					</a></li>
					<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
<?php }?>
<div class="clearfloat"></div>
<div id="f-mobile-footer">
<ul id="f-mobile-menu">
<li> <a href="<?php echo BLOG_URL; ?>"> <span class="fa fa-home"></span> 首页 </a></li>
<li> <a href="<?php echo BLOG_URL; ?>t"> <span class="fa fa-twitch"></span> 微语 </a></li>
<li> <a href="javascript:;" class="fly-search-s"> <span class="fa fa-search"></span> 搜索 </a></li>
<li> <a href="<?php echo BLOG_URL; ?>about"> <span class="fa fa-info"></span> 关于 </a></li>
<li id="mobile-login"><a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank"> <span class="fa fa-user"></span> 用户 </a></li>
</ul>
</div>
</div>
<footer class="footer">
  <div class="container copy-right">
    <div class="footer-tag-list">
		<?php echo $footer_info; ?>
        <span>Copyright © 2017 <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
        <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> </span>
		<span>Powered by <a href="http://www.emlog.net" target="_blank">Emlog</a> · Theme by <a href="http://pjax.cn" target="_blank">Finally</a></span>
    </div>
  </div>
</footer>
<div class="loading"><div class="loading1"><div class="block"></div><div class="block"></div><div class="block"></div><div class="block"></div><div class='section-left'></div><div class='section-right'></div></div></div>
<div class="rollbar"><ul>
<li class="conment-btn"></li>
<li><a href="javascript:(scrollTo());"><i class="fa fa-chevron-up"></i></a><h6>去顶部<i></i></h6></li>
</ul></div>
<div class="search-forms">
	<form method="get" action="<?php echo BLOG_URL;?>">
		<div class="search-form-inner">
			<div class="search-form-box">
				 <input class="form-search" type="text" name="keyword" placeholder="键入搜索关键词">
				 <button type="submit" id="btn-search" class="search-go"><i class="fa fa-search"></i> </button>
				 
			</div>
			<div class="search-commend">
				<h4>大家都在搜</h4>
				<ul>
					<?php search_tag($title); ?>
				</ul>
			</div>
		</div>                
	</form> 
	<div class="close-search">
		<span class="close-top"></span>
		<span class="close-bottom"></span>
    </div>
</div>
<?php if($Tconfig['bg_mbl']== 1 ){echo '<div class="bg-fixed"></div>';} ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.swipebox.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/masonry.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/main.js"></script>
<script>
$(function() {$("img.lazy").lazyload({effect: "fadeIn"});});
$( document ).ready(function() {$('.swipebox' ).swipebox();});
if($("#wowslider-container1").length>0){$.getScript(''+ pjaxtheme +'js/slider.js');}
</script>
<?php
if($Tconfig['rtc']== 1 ){
?>
<script>
$(document).ready(function(){
	if (!lcs.get('tb_wintips_ts') > 0) {
		stap.wintips_close = function() {
			$('.wintips').fadeOut()
				lcs.set('tb_wintips_ts', $.now())
		}
		setTimeout(function() {
			$('body').append('<div class="wintips">\
				<div class="wintips-thumb"><img src="'+ pjaxtheme +'img/flyman.png"></div>     <h2><?php echo htmlspecialchars($Tconfig['rtcbt']); ?></h2>\
				<p><?php echo htmlspecialchars($Tconfig['rtccn']); ?></p>\
				<p><a href="<?php echo htmlspecialchars($Tconfig['rtcurl']); ?>" class="btn btn-info btn-wintips">查看详情</a></p>\ <span etap="wintips_close" class="wintips-close"><i class="fa fa-times-circle-o"></i></span>\
			</div>')
			$('.wintips').fadeIn()
		}, 1000);
	}
})
</script>
<?php } ?>
<?php
if($Tconfig['aos']== 1 ){
?>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/aos.css" />
<script type="text/javascript">
AOS.init({
	offset: 200,
	duration: 500,
	easing: 'ease-in-sine',
	delay: 100,
	once: true,
});
</script>
<?php } ?>
<?php doAction('index_footer');?>
<?php doAction('index_bodys');?>
</body>
</html>