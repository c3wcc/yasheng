<?php 
/*
 * @Emlog大前端4.5
 * @authors 小草 (blog.yesfree.pw)
 * @date    2016-4-10
 * @version 4.0
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if (ROLE == ROLE_ADMIN):
require_once(EMLOG_ROOT.'/content/templates/Dream/config.php');
//echo TEMPLATE_URL.'config.php';
require_once('setting_fun.php');
plugin_setting();
?>
<link rel='stylesheet' id='set-css'  href='<?php echo TEMPLATE_URL; ?>css/set.css' type='text/css' media='all' />

<div id="primary" class="left-column">
<div id="setting" >
<main id="main" class="site-main" role="main">
 <form action="?setting&do=save" method="post" id="input" class="da-form">
  <div class="set_nav">
	<ul>
		<li class="active"><a href="#sethome">基本配置</a></li>
		<li class="last"><input type="submit" value="保 存" class="svae" /></li>
	</ul>
</div>
<div class="set_cnt">
<div class="set_box" id="sethome" style="display:block">
<div class="da-form-row">
<td class="right_td">建站时间:(无视这个)</td>
<td class="left_td"><input size="10" name="timedate" type="text" value="<?php echo $timedate; ?>" id="datepicker" style="width: 250px;"/></td>
<span class="right_td"><input type="checkbox" value="1" name="timehide" <?php if($timehide == 1):?> checked<?php endif;?> /> 显示</span>
</div>
<div class="da-form-row">
<td class="right_td">网名 (<span style="color:red; font-weight:bold">支持html代码</span>)</td><br/>
<p><textarea name="home_toptext" style="width: 250px;"/><?php echo $home_toptext; ?></textarea></p>
</div>
<div class="da-form-row">
<td class="right_td">签名</td>
<span style="padding-left:43px;"><input type="text" name="heightkey" size="10" value="<?php echo $heightkey; ?>" style="width: 250px;"/></span>
</div>
<div class="da-form-row">
<td class="right_td">首页顶部图片设置：</td>
<td class="left_td"><input size="10" name="logo_url" type="text" value="<?php echo $logo_url; ?>" id="" style="width: 250px;"/></td>
</div>
<div class="da-form-row">
<td class="right_td">首页头像设置：</td>
<td class="left_td"><input size="20" name="new_log_num" type="text" value="<?php echo $new_log_num; ?>" style="width: 250px;"/></td>
</div>

<div class="da-form-row">
<td class="right_td">首页配图获取方式</td>
<span class="right_td">
<td class="left_td"><input name="module_thum" type="radio" value="0" <?php if ($module_thum == "0") echo 'checked'?> ></input></td>
<td class="right_td">获取内容第一张图片</td>
<td class="right_td"><input name="module_thum" type="radio"  value="1" <?php if ($module_thum == "1") echo 'checked'?>></input></td>
<td class="right_td">获取附件中第一张图片</td>
</span>
</div>
<div class="da-form-row">
<td class="right_td">图片懒加载(暂时去除)</td>
<span class="right_td">
<td class="left_td"><input name="webcompress" type="radio" value="1" <?php if ($webcompress == "1") echo 'checked'?> ></input></td>
<td class="right_td">启用</td>
<td class="right_td"><input name="webcompress" type="radio"  value="0" <?php if ($webcompress == "0") echo 'checked'?>></input></td>
<td class="right_td">禁用</td>
</span>
</div>
<div class="da-form-row">
<p>对本主题有任何意见或建议，请到 <a href="http://cnm1.cn/">我的博客</a> 留言，或者直接 QQ 联系开发者。</p>
<p>开发者：1梦</p>
<p>QQ：2107228359</p>
<p>Q群交流：648194214<p>
</div>
</div>  
</div>
</form>
</main>
</div>
</div>
<script>
$(function(){
	$(".set_nav li").not(".set_nav .last").click(function(e) {
		e.preventDefault();
		$(this).addClass("active").siblings().removeClass("active");
		$($(this).children("a").attr("href")).show().siblings().hide();
	});
	
  })
</script>	
<?php else:?>
<?php 
header("Location:".BLOG_URL.""); 
exit;
?> 
<?php endif; ?>

<?php
 include View::getView('footer');
?>