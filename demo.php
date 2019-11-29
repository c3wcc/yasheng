<?php
/**
 * 文件演示页面
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';
$id=addslashes($_GET['id']);
$options_cache = $CACHE->readCache('options');
$db = MySql::getInstance();
$data = $db->query("SELECT * FROM ".DB_PREFIX."cpdown WHERE logid ='$id'");
$row = $db->fetch_array($data);
$title = htmlspecialchars($row['name']);
$size = htmlspecialchars($row['size']);
$up_date = htmlspecialchars($row['up_date']);
if(empty($id)){
	emDirect(BLOG_URL);
}elseif(empty($row['yanshi'])){
	emDirect(BLOG_URL);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title><?php echo $title; ?> - <?php echo $options_cache['blogname']; ?></title>
<meta name="Keywords" content="云梦博客-资源分享平台" />
<meta name="description" content="云梦博客是一家乐享资源记忆点滴的博客,主要分享程序源码,站长工具,游戏软件,免费空间,模板插件,手机ROM,各类资源,各类教程,QQ资源,手机应用,致力创造一个高质量网络资源教程的分享平台." />
    <link href="http://img.chinaz.com/max-templates/passport/styles/topbar.css" type="text/css" rel="Stylesheet" />
    <link href="http://sc.chinaz.com/style/style_kj.css" type="text/css" rel="stylesheet" />
    <link href="http://sc.chinaz.com/style/demo.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="http://sc.chinaz.com/style/js/jquery-1.2.pack.js"></script>
<script type="text/javascript">
var theme_list_open = false;
$(document).ready(function () {
	function fixHeight() {
		var headerHeight = $("#switcher").height();
		$("#iframe").attr("height", $(window).height()-84 + "px");
	}
	$(window).resize(function () {
		fixHeight();
	}).resize();
	//响应式预览
	$('.icon-monitor').addClass('active');
	$(".icon-mobile-3").click(function () {
		$("#by").css("overflow-y", "auto");
		$('#iframe-wrap').removeClass().addClass('mobile-width-3');
		$('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	$(".icon-mobile-2").click(function () {
		$("#by").css("overflow-y", "auto");
		$('#iframe-wrap').removeClass().addClass('mobile-width-2');
		$('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	$(".icon-mobile-1").click(function () {
		$("#by").css("overflow-y", "auto");
		$('#iframe-wrap').removeClass().addClass('mobile-width');
		$('.icon-tablet,.icon-mobile,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	$(".icon-tablet").click(function () {
		$("#by").css("overflow-y", "auto");
		$('#iframe-wrap').removeClass().addClass('tablet-width');
		$('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	$(".icon-monitor").click(function () {
		$("#by").css("overflow-y", "hidden");
		$('#iframe-wrap').removeClass().addClass('full-width');
		$('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
		$(this).addClass('active');
		return false;
	});
});
</script>
<script type="text/javascript">
function Responsive($a) {
	if ($a == true) $("#Device").css("opacity", "100");
	if ($a == false) $("#Device").css("opacity", "0");
	$('#iframe-wrap').removeClass().addClass('full-width');
	$('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
	$(this).addClass('active');
	return false;
};
</script>
<!-- txiaohe.cn Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?5820c52fd7dbfc2f437ee16a493b4a75";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body id="by" style="overflow-y: hidden" >
<div id="switcher">
  <div class="center">
    <ul>
    <li class="logoTop">资源在线预览</li>
      <div id="Device">
        <li class="device-monitor"><a href="javascript:"><div class="icon-monitor"></div></a></li>
        <li class="device-mobile"><a href="javascript:"><div class="icon-tablet"> </div></a></li>
        <li class="device-mobile"><a href="javascript:"><div class="icon-mobile-1"> </div></a></li>
        <li class="device-mobile-2"><a href="javascript:"><div class="icon-mobile-2"> </div></a></li>
        <li class="device-mobile-3"><a href="javascript:"><div class="icon-mobile-3"> </div></a></li>
      </div>
      
      
    </ul>
    <div class="muen_top">
     <a href="http://www.23yue.cn" class="indexactive">首页</a>
     <a href="http://h.23yue.cn/sort/source"  class="l11active" target="_blank">残月导航</a>
     <a href="http://mz.23yue.cn/"  class="l11active" target="_blank">秒赞秒评</a>
     <a href="http://x.23yue.cn/"  class="l11active" target="_blank">残月小说</a>
    </div>
    <div class="tougao">
    <a  href="<?php echo BLOG_URL; ?>download.php?id=<?php echo $id; ?>" target="_blank">立即下载</a>
    </div>
  </div>
</div>
<div id="iframe-wrap">

	<iframe id="iframe" src="<?php echo $row['yanshi']; ?>" frameborder="0"   width="100%" height="100%"> </iframe>

</div>
<div id="footer-notice" class="kj_bottom">
	<div style=" width:980px; margin:0 auto">
		<p class="left cut">
			<span>名称：</span>
            <a href="<?php echo BLOG_URL; ?>download.php?id=<?php echo $id; ?>" title="点击下载" class="down" target="_blank"><?php echo $title; ?></a>
			<span>文件大小：</span><span><?php echo $size; ?></span>
			<span>更新时间：</span><span><?php echo $up_date; ?></span>
		</p>
		<p class="left">
			<span>分享到：</span>
			<a title='分享到新浪微博' href="javascript:void(0)" id="fxwb" class="sn">新浪</a>
			<a title='分享到腾讯微博' href='javascript:void(0)' onclick=posttoWb() class="tx">腾讯</a>
			<a title="分享到QQ空间" href="javascript:window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href));void(0)" class="qq">QQ空间</a>
		</p>
		<div class="clear"></div>
	</div>
</div>

	<script type="text/javascript">

	    var description = '<?php echo $title; ?>_<?php echo $options_cache['blogname']; ?>';



	    var sendT = {
	        getHeader: function () {
	            var g_title = description;
	            var re = /<[^<>]*?font[^<>]*?>/gi;
	            g_title = g_title.replace(re, "");
	            return g_title;
	        },
	        getFirstImgSrc: function () {
	            var allPageTags = document.getElementsByTagName("div");
	            for (var i = 0; i < allPageTags.length; i++) {
	                if (allPageTags[i].className == 'downtext') {
	                    if (allPageTags[i].getElementsByTagName("img")[0] && allPageTags[i].getElementsByTagName("img")[0].width > 200) {
	                        return allPageTags[i].getElementsByTagName("img")[0].src;
	                    }
	                    else {
	                        return null;
	                    }

	                }
	            }
	        },
	        getContent: function () {
	            var allPageTagss = document.getElementsByTagName("div");
	            for (var i = 0; i < allPageTagss.length; i++) {
	                if (allPageTagss[i].className == 'downtext') {
	                    return allPageTagss[i].innerHTML;
	                }
	            }
	        }
	    }



	    document.getElementById("fxwb").onclick = function () {
	        (function (s, d, e, r, l, p, t, z, c) {
	            var f = 'http://service.weibo.com/share/share.php?appkey=872996044&', u = z || d.location, p = ['url=', e(u), '&title=', e(sendT.getHeader()), '&source=', e(r), '&sourceUrl=', e(l), '&content=', c || 'gb2312', '&pic=', e(p || '')].join('');
	            function a() {
	                if (!window.open([f, p].join(''), 'mb', ['toolbar=0,status=0,resizable=1,width=440,height=430,left=', (s.width - 440) / 2, ',top=', (s.height - 430) / 2].join(''))) u.href = [f, p].join('');
	            };
	            if (/Firefox/.test(navigator.userAgent)) setTimeout(a, 0); else a();
	        })(screen, document, encodeURIComponent, 'CHINAZ', 'http://sc.chinaz.com/', sendT.getFirstImgSrc(), null, null, null);
	    }


	    function posttoWb() {
	        var _tt = description;
	        var _t = encodeURI(_tt.replace(/\s+$/, ''));
	        var _url = encodeURI(window.location);
	        var _appkey = encodeURI("258efff116d2466da9b7513cbae7de0b");
	        var _site = encodeURI('sc.chinaz.com');
	        var _pic = sendT.getFirstImgSrc();
	        var _u = 'http://v.t.qq.com/share/share.php?title=' + _t + '&url=' + _url + '&appkey=' + _appkey + '&site=' + _site + '&pic=' + _pic;
	        window.open(_u, '转播到腾讯微博', 'width=700, height=580, top=320, left=180, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');
	    }

 
</script>
<script src="http://my.chinaz.com/_topbar.aspx?proxy=/httpproxy.aspx" type="text/javascript" charset="UTF-8"></script>
<script type="text/javascript" src="/js/softinfo.js.aspx?id=533693" defer="defer" charset="UTF-8"></script>
<div style="display:none">
<script src="http://s4.cnzz.com/stat.php?id=1256674613&web_id=1256674613" language="JavaScript"></script>
</div>
</body>
</html>
