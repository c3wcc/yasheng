<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
</div>
<div class="clear"></div>
<div class="blackground"></div>
<div title="返回顶部(或任意位置双击左键)" class="backtop"></div>
<nav id="mmenu" role="navigation">
  <ul>
    <li>
      <div class="msearch">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
          <input type="text" name="keyword" placeholder="搜搜更健康" />
          <input type="submit" name="submit" value="搜索" />
        </form>
      </div>
    </li>
    <?php blog_navi();?>
  </ul>
</nav>
</div>
</div>
<footer id="footer" role="contentinfo">
  <address>
  文章中出现的商标及图像版权属于其合法持有人，只供传递信息之用，非商务用途。互动交流时请遵守理性，宽容，换位思考的原则。</br></br>
  <i class="fa fa-html5"></i> Copyright&nbsp;©&nbsp;2012-<?php echo date('Y',time())?>&nbsp;<?php echo $blogname; ?>
  <div class="copyright">&nbsp;|&nbsp;勉强运行：<?php echo floor((time()-strtotime(""._g('webtime').""))/86400); ?>天&nbsp;|&nbsp;<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>&nbsp;|&nbsp;<?php echo $footer_info; ?>
    <?php doAction('index_footer'); ?>
    &nbsp;|&nbsp;自豪的采用 <a href="http://www.521mz.cn" title="Emlog <?php echo Option::EMLOG_VERSION;?>" target="_blank">Emlog <?php echo Option::EMLOG_VERSION;?></a>&nbsp;驱动&nbsp;|&nbsp;<?php echo strtoupper(runtime_display()); ?>&nbsp;|&nbsp;主题：<a href="http://www.521mz.cn" title="天蓝云淡" target="_blank">Colorful[七彩优化版]</a></div>
  </address>
</footer>
<script><?php if(_g('eqi')==1):?>eqi="ul:first";<?php else: ?>eqi="ul:first<?php for($i = 1; $i <= _g('eqi'); $i++) {echo ",ul:eq(".$i.")";}?>";<?php endif;?><?php if(_g('clsqkg')==1):?>blog="<?php echo _g('clsq');?>";<?php else: ?>blog="<?php echo $site_title; ?>";<?php endif;?>function pjaxfooter(){<?php echo _g('pjaxdm');?>}<?php if(_g('cnzz')==1):?>_czc.push(["_trackPageview",window.location.pathname,document.location.href]);<?php endif;?></script>
<?php if(_g('loading')==1):?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/pace.min.js?v=20160704"></script>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/pace14.css?v=20160731" />
<div class="colorful_loading_frame"></div>
<?php else: ?>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/loading.css?v=20160731" />
<div class="colorful_loading_frame">
  <div class="colorful_loading"><i class="rect1"></i><i class="rect2"></i><i class="rect3"></i><i class="rect4"></i><i class="rect5"></i></div>
</div>
<?php endif;?>
<?php empty($_COOKIE['myhk_bg']) ? $bgimgsrc = TEMPLATE_URL . 'images/bg/' . rand(1, 10) . '.jpg?v=new' : $bgimgsrc = TEMPLATE_URL . 'images/bg/' . $_COOKIE["myhk_bg"] . '.jpg' ;?>
<img class="bg-image" src="<?php echo $bgimgsrc; ?>" /><div class="bg-image-pattern"></div>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/realgravatar.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.js?v=20150310"></script>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.css?v=20141026" />
<?php if(_g('pjax')==1):?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/pjax.min.js?v=20170203"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global-pjax.js?v=20170216"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global.js?v=20150912"></script>
<?php endif;?>
<?php doAction('myhk_player'); ?>
<?php if(isset($_GET["music"])):?>
<script>setTimeout(function() {play(<?php echo $_GET["music"]; ?>);}, 5000)</script>
<?php endif;?>
</body>
</html>