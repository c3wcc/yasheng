<?php 
/*
 * lycms 控制台
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if (ROLE == ROLE_ADMIN){
$sort_cache = $CACHE->readCache("sort");
?>
<form action="" method="post" id="input">
<div class="new-setting">
	<input type="submit" value="保 存" class="save">
	<div class="new_settingid">
	<ul>
		<li class="sheji active"><a href="#sethome" title="基本配置"><i class="fa fa-inbox"></i> 基本配置</a></li>
		<li class="sheji"><a href="#extend" title="扩展配置"><i class="fa fa-list"></i>扩展配置</a></li>
		<li class="sheji"><a href="#sange" title="首页三格"><i class="fa fa-list"></i>首页三格</a></li>
	</ul>
	</div>
	<div class="setting-txt">
		<a href="<?php echo BLOG_URL; ?>admin/?action=logout" title="退出"><i class="fa fa-power-off"></i></a>
		<a href="<?php echo BLOG_URL; ?>admin" title="后台"><i class="fa fa-cog"></i></a>
	</div>
</div>
<div class="new_settingid">
<div class="setting-box" id="sethome" style="display: block;">
	<h1>基础功能</h1>
	<div class="setting-form">
		<span class="setting-title">站点LOGO:</span>
		<input size="24" name="config[logo]" type="text"  value="<?php echo $Tconfig["logo"]; ?>"/>
	</div>
	<div class="setting-form">
		<span class="setting-title">源码压缩:</span>
		<span><input name="config[compress_html]" type="radio" value="1"  <?php if ($Tconfig["compress_html"] == "1") echo 'checked'?>>开</span>
		<span><input name="config[compress_html]" type="radio" value="2"  <?php if ($Tconfig["compress_html"] == "2") echo 'checked'?>>关</span>
	</div>
	<div class="setting-form">
		<span class="setting-title">内页热门:</span>
		<span><input name="config[popular]" type="radio" value="1"  <?php if ($Tconfig["popular"] == "1") echo 'checked'?>>开</span>
		<span><input name="config[popular]" type="radio" value="2"  <?php if ($Tconfig["popular"] == "2") echo 'checked'?>>关</span>
	</div>
	<div class="setting-form">
		<span class="setting-title">QQ:</span>
		<input name="config[qqhm]" type="text"  value="<?php echo $Tconfig["qqhm"]; ?>">
	</div>
	<div class="setting-form">
		<span class="setting-title">友联URL:</span>
		<input name="config[links]" type="text"  value="<?php echo $Tconfig["links"]; ?>">
	</div>	
	<div class="setting-form">
		<span class="setting-title">投稿URL:</span>
		<input name="config[tougao]" type="text"  value="<?php echo $Tconfig["tougao"]; ?>">		
	</div>
	<div class="setting-form">
		<span class="setting-title">合作URL:</span>
		<input name="config[hezuo]" type="text"  value="<?php echo $Tconfig["hezuo"]; ?>">		
	</div>
	<div class="setting-form">
		<div class="setting-boye">
			<span class="setting-title">分类ID:</span>
			<input name="config[cms_id]" type="text"  value="<?php echo $Tconfig["cms_id"]; ?>">
		</div>
		提示：多个模块之间用英文<span style="color:red">逗号</span>隔开即可！
	</div>

	
</div>
<div class="setting-box" id="extend" style="display: none;">  
	<h2>菜单栏更多功能</h2>
    <div class="setting-form">
		<span class="setting-title">更多功能:</span>
		<span><input name="config[menu_more]" type="radio" value="1"  <?php if ($Tconfig["menu_more"] == "1") echo 'checked'?>>开</span>
		<span><input name="config[menu_more]" type="radio" value="2"  <?php if ($Tconfig["menu_more"] == "2") echo 'checked'?>>关</span>
	</div>
	<p>菜单栏更多功能扩展<span>支持html代码</span></p>
	<p><textarea name="config[menu_html]" rows="8"><?php echo $Tconfig["menu_html"]; ?></textarea></p>
	<h1>广告模块</h1>
	<div class="setting-form">
		<span class="setting-title">广告开关:</span>
		<span><input name="config[add_gg]" type="radio" value="1"  <?php if ($Tconfig["add_gg"] == "1") echo 'checked'?>>开</span>
		<span><input name="config[add_gg]" type="radio" value="2"  <?php if ($Tconfig["add_gg"] == "2") echo 'checked'?>>关</span>
	</div>
	<div class="setting-form">
	    <div id="set_ly">	
		     <span class="setting-title">地址1:</span>
			 <input name="config[add_url1]" type="text"  value="<?php echo $Tconfig["add_url1"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">图片1:</span>
			<input name="config[add_tu1]" type="text"  value="<?php echo $Tconfig["add_tu1"]; ?>">
			
		</div>
	</div>
	<div class="setting-form">
	    <div id="set_ly">	
		     <span class="setting-title">地址2:</span>
			 <input name="config[add_url2]" type="text"  value="<?php echo $Tconfig["add_url2"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">图片2:</span>
			<input name="config[add_tu2]" type="text"  value="<?php echo $Tconfig["add_tu2"]; ?>">			
		</div>
	</div>
	<div class="setting-form">
	    <div id="set_ly">	
		     <span class="setting-title">地址3:</span>
			 <input name="config[add_url3]" type="text"  value="<?php echo $Tconfig["add_url3"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">图片3:</span>
			<input name="config[add_tu3]" type="text"  value="<?php echo $Tconfig["add_tu3"]; ?>">			
		</div>
	</div>
</div>
<div class="setting-box" id="sange" style="display: none;"> 
    <div class="setting-form">
		<span class="setting-title">首页三格开关:</span>
		<span><input name="config[sange_more]" type="radio" value="1"  <?php if ($Tconfig["sange_more"] == "1") echo 'checked'?>>开</span>
		<span><input name="config[sange_more]" type="radio" value="2"  <?php if ($Tconfig["sange_more"] == "2") echo 'checked'?>>关</span>
	</div>
	<h1>模块1</h1>
	<div class="setting-form">
		<div class="setting-boye">
			<span class="setting-title">图标:</span>
			<input name="config[tubiao1]" type="text"  value="<?php echo $Tconfig["tubiao1"]; ?>">
		</div>
		 <div id="set_ly">	
		     <span class="setting-title">地址:</span>
			 <input name="config[sange_url1]" type="text"  value="<?php echo $Tconfig["sange_url1"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">标题:</span>
			<input name="config[sange_biaoti1]" type="text"  value="<?php echo $Tconfig["sange_biaoti1"]; ?>">		
		</div>
		<div id="set_ly">	
		    <span class="setting-title">简介:</span>
			<input name="config[sange_jianjie1]" type="text"  value="<?php echo $Tconfig["sange_jianjie1"]; ?>">
		</div>
	</div>
	<h1>模块2</h1>
	<div class="setting-form">
		<div class="setting-boye">
			<span class="setting-title">图标:</span>
			<input name="config[tubiao2]" type="text"  value="<?php echo $Tconfig["tubiao2"]; ?>">
		</div>
		 <div id="set_ly">	
		     <span class="setting-title">地址:</span>
			 <input name="config[sange_url2]" type="text"  value="<?php echo $Tconfig["sange_url2"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">标题:</span>
			<input name="config[sange_biaoti2]" type="text"  value="<?php echo $Tconfig["sange_biaoti2"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">简介:</span>
			<input name="config[sange_jianjie2]" type="text"  value="<?php echo $Tconfig["sange_jianjie2"]; ?>">
		</div>
	</div>
	<h1>模块3</h1>
	<div class="setting-form">
		<div class="setting-boye">
			<span class="setting-title">图标:</span>
			<input name="config[tubiao3]" type="text"  value="<?php echo $Tconfig["tubiao3"]; ?>">
		</div>
		 <div id="set_ly">	
		     <span class="setting-title">地址:</span>
			 <input name="config[sange_url3]" type="text"  value="<?php echo $Tconfig["sange_url3"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">标题:</span>
			<input name="config[sange_biaoti3]" type="text"  value="<?php echo $Tconfig["sange_biaoti3"]; ?>">
		</div>
		<div id="set_ly">	
		    <span class="setting-title">简介:</span>
			<input name="config[sange_jianjie3]" type="text"  value="<?php echo $Tconfig["sange_jianjie3"]; ?>">
		</div>
	</div>
</div>   
</div>
</form>
<script>
$(document).ready(function(){
	$('.save').click(function (){
		$(this).val("正在修改");
		var params = $('#input').serialize();
		$.ajax({
			url:blog_url + '?setting&do=save',
			type:'post',
			dataType:'json',
			data:params,
			success:ajax_setting
		});
		return false;
	});
});
function ajax_setting(json) {
	if(json.code=='200'){
		$.message('修改成功');
	}else if(json.code=='201'){
		$.message({ message:'修改失败', type:'fa fa-times c-message--error'});
	}
	setTimeout(function() {
		$(".save").val("保存设置");
	},500);
}
$(function(){
	$(".new_settingid li").not(".new_settingid .last").click(function(e) {
		e.preventDefault();
		$(this).addClass("active").siblings().removeClass("active");
		$($(this).children("a").attr("href")).show(500).siblings().hide(500);
	});
});
</script>
<?php include View::getView('footer');?>
<?php }else{
header("Location:".BLOG_URL.""); 
exit;
} ?>