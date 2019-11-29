<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
		</div>
	</div>
</div>
<!--底部-->
<footer class="footer">
<div class="footer-a">
	<span>Copyright © <?php echo date('Y'); ?><a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>"><?php echo $blogname; ?></a>
	</span>
	<span class="nofo">
	<a href="http://www.emlog.net" title="至强EMLOG系统" rel="nofollow" target="_blank">EMLOG</a>
	<a href="<?php echo TEMPLATE_URL; ?>sitemap.php" title="sitemap">sitemap</a>
	<a href="" title="备案号" rel="nofollow" target="_blank"><?php echo $icp; ?></a>
	<?php echo $footer_info; ?>
	</span>
</div>
</footer>
<div id="menu-footer">
<ul>
<li><a href="<?php echo BLOG_URL; ?>"><span class="fa fa-home"></span>首页</a></li>
<li class="login-nav"<?php if(!islogin()){ ?><?php }else{ ?>style="display:none"<?php }?>><a href="#" data-target="#myLogin" data-toggle="modal" target="_blank"><span class="fa fa-user"></span> 用户</a></li>
<li class="logout-nav"<?php if(!islogin()){ ?>style="display:none"<?php }else{ ?><?php }?>> <a href="<?php echo BLOG_URL; ?>?meta&home"><span class="fa fa-user-circle-o"></span>个人中心</a></li>
</ul>
</div>
<div class="so-search-bar" style="display: none;">
	<form method="get" action="<?php echo BLOG_URL;?>">
		<input type="search" placeholder="输入关键词搜索..." value="" name="keyword">
	</form>
</div>
<ul id="lanyou"><li class="upper ScrollUp"><a href="javascript:void(0);"><i class="fa fa-chevron-up"></i></a></li> <li class="lower ScrollUp"><a href="javascript:void(0);"><i class="fa fa-chevron-down"></i></a></li> </ul>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/navmenu.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/prettify.js"  type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/message.min.js"  type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.swipebox.js"  type="text/javascript"></script>
</body>
</html>
<?php
if($Tconfig["compress_html"]== 1 ){
        $html=ob_get_contents();
        ob_get_clean();
        echo em_compress_html_main($html);
}
?>
