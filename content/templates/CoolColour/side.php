<?php 
/**
 * 侧边栏
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--=========右侧开始==========-->
<aside class="myaside">
<!--关注我-->
<div class="bg-color web-author  translucent mb30">
	<div class="author-tx ">
		<a class="circle" href="/" title="点击查看详细信息">
			<img class="circle" src="/content/uploadfile/201707/thum-641f1501303293.jpg">
		</a>
	</div>
	<div class="author-name  bgdiv"><span class="t-blue">雨 天</span>
		<p>我不愿让你一个人
			<br>
			<a id="me" href="tencent://message/?uin=571614181">你&nbsp;主&nbsp;动&nbsp;我&nbsp;们&nbsp;就&nbsp;会&nbsp;有&nbsp;故&nbsp;事</a>
			
		</p>
	</div>
	<div class="data-info">
		<?php tongji(); ?>
	</div>
</div>
<div class="focus-me bg-color animation-div">
	<h4 class="index-title"><i class="el-heart"></i>关注我<small>Focus Me</small></h4>
		<div class="xiangguan">
			
				<div><a class="benbo" href="/?post=4"><i class="el-download-alt"></i></a><span>本站主题</span></div>
			<div><a class="taobao" href="http://www.12580sky.com" target="_blank"><i class="el-th-large"></i></a><span>小高教学网</span></div>
			<div><a class="mail-btn" href="http://weifenshi.com" target="_blank"><i class="el-video-alt"></i></a><span>优惠券领取</span></div>
				<div><a class="side-fx"><i class="el-share-alt"></i></a><span>分享本站</span></div>
		</div>

			
		<div class="bd-fx side-bdfx ">
			<i class="el-remove fx-close"></i>
			<ul class="bdsharebuttonbox">
				<li><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></li>
				<li><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></li>
				<li><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a></li>
				<li><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a></li>
			</ul>
		</div>
</div>
<?php 
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
doAction('diff_side');
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>


</aside>
<!--=========END右侧==========-->
