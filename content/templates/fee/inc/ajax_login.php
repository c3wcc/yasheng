<?php 
/**
 * 登陆页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
$is_gslogin = is_file(EMLOG_ROOT.'/content/plugins/gslogin/gslogin.php') ? true : false;
?>
<div id="sign">
	<div class="part loginPart">
		<form id="formtest" action="" method="post">
			<div id="register-active" class="switch">
				<i class="fa fa-toggle-on"></i>切换注册
			</div>
			<h3>登录</h3>
			<p class="status" id="contentdiv_a"></p>
			<p>
				<label class="icon" for="username"><i class="fa fa-user"></i></label>
				<input class="input-control" id="input1" type="text" placeholder="请输入用户名" name="user" required="" aria-required="true" <?php if($Tconfig["loginpen"]== 2 ){echo 'disabled="disabled"';}?>>
			</p>
			<p>
				<label class="icon" for="password"><i class="fa fa-lock"></i></label>
				<input class="input-control" id="input2" type="password" placeholder="请输入密码" name="pw" required="" aria-required="true" <?php if($Tconfig["loginpen"]== 2 ){echo 'disabled="disabled"';}?>>
			</p>
			<?php if(Option::get('login_code') == 'y'){ ?>
											<div class="input-group input-login">
												<span class="input-group-addon"><i class="fa fa-file-code-o faw"></i></span>
												<input class="form-control lbtn" placeholder="请填写验证码" id="imgcode" name="imgcode" type="text" value=""/>
												<span class="ajax_reg_imgcode imgcode"><img src="/include/lib/checkcode.php" id="code"/></span>
											</div>
											<?php };?>
			<p class="safe">
				<label class="remembermetext" for="rememberme"><input name="ispersis" type="checkbox" checked="checked" id="ispersis" class="rememberme" value="forever">记住我的登录</label>
				
			</p>
			<p>
				<input class="submit" type="button" value="<?php if($Tconfig["loginpen"]== 2 ){echo '暂不开放';}else{echo '立即';};?>登录" name="send_ajax" id="send_ajax" <?php if($Tconfig["loginpen"]== 2 ){echo 'disabled="disabled"';}?>>
			</p>
			<a class="close"><i class="fa fa-times"></i></a>
		</form>
		<div class="other-sign">
			<p>
				您也可以使用第三方帐号快捷登录
			</p>
			<?php if($Tconfig["qq_login"]== 1){?>
			<div>
				<a class="ajax_qq_login qqlogin" href="javascript:;"><i class="fa fa-qq"></i><span>Q Q 登 录</span></a>
			</div>
			<?php }?>
			<?php if($is_gslogin){ ?>
			<div>
				<a href="javascript:;" class="ajax_login_code smdl" title="扫码登陆"><span class="fa fa fa-qrcode"></span></a>
			</div>
			<?php }?>
		</div>
	</div>
	<div class="part registerPart">
		<form id="refrom" action="" method="post">
			<div id="login-active" class="switch">
				<i class="fa fa-toggle-off"></i>切换登录
			</div>
			<h3>注册</h3>
			<p class="status" id="contentdiv_b"></p>
			<p>
				<label class="icon" for="user_name"><i class="fa fa-user"></i></label>
				<input class="input-control" type="text" name="reusername" placeholder="请输入用户名" required="" aria-required="true" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
			</p>
			<p>
				<label class="icon" for="user_email"><i class="fa fa-envelope"></i></label>
				<input class="input-control" type="email" name="regemail" placeholder="输入常用邮箱" required="" aria-required="true" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
			</p>
			<p>
				<label class="icon" for="user_pass"><i class="fa fa-lock"></i></label>
				<input class="input-control" type="password" name="repassword" placeholder="请输入密码" required="" aria-required="true" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
			</p>
			<p>
				<label class="icon" for="user_pass2"><i class="fa fa-retweet"></i></label>
				<input class="input-control" type="password" name="repassword2" placeholder="再次输入密码" required="" aria-required="true" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
			</p>
			<p>
				<input class="form-control rbtn" placeholder="请输入验证码" id="reimgcode" name="reimgcode" type="text" value="" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
				<span class="ajax_reg_imgcode imgcode"><?php if($Tconfig["regopen"]== 1 ){?><img src="/include/lib/checkcode.php" id="recode"/><?php }?></span>
			</p>
			<p>
				<input class="submit inline" type="button" value="<?php if($Tconfig["regopen"]== 2 ){echo '暂不开放';}else{echo '立即';};?>注册" name="re_ajax" id="re_ajax" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>>
			</p>
			<a class="close"><i class="fa fa-times"></i></a>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.ljzc').click(function(){
		$('.sign-login').hide();
		$('.sign-saomiao').hide();
		$('.sign-zhaohui').hide();
		$('.sign-reg').show();
	});
	$('.wjmm').click(function(){
		$('.sign-login').hide();
		$('.sign-reg').hide();
		$('.sign-saomiao').hide();
		$('.sign-zhaohui').show();
	});
	$('.ljdl').click(function(){
		$('.sign-reg').hide();
		$('.sign-saomiao').hide();
		$('.sign-zhaohui').hide();
		$('.sign-login').show();
	});
	$('.smdl').click(function(){
		$('.sign-saomiao').fadeIn();
	});
	$('.closea').click(function(){
		$('.sign-saomiao').fadeOut();
	});
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=ajax',
		type:'post', 
		dataType:'json', 
		success:update_page
	});
	$('.ajax_qq_login').on('click',function(){
		window.open(pjaxtheme + "inc/ajax.php?a=qq_login", "qq_bangding", "top=200,left=200,height=600, width=800, toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
	});
	$(".login_logout").click(function(){
		$.get(pjaxtheme + "inc/ajax.php?a=ajax_logout");
		$('.login-nav').show();
		$('.logout-nav').hide();
		$('#user-login').show();
		$('#user-div').hide();
	});	
	$('#pwre_ajax').click(function(){
		var xemail = $('#reemail').val();
		var isxemail = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
		if (xemail=='') {
			$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="#87CEFA">邮箱不能为空</font>'); 
		}else if(!isxemail.test(xemail)){
			$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="#87CEFA">邮箱格式不正确</font>'); 
		}else{
			$.ajax({
				url:pjaxtheme + 'inc/pwre.php',
				type:'post', 
				dataType:'json', 
				data:{email:xemail}, 
				success:function(data){
					if (data.status=='1') {
						$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="#87CEFA">该邮箱尚未注册</font>'); 
					}else{
						$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="#87CEFA">'+data.msg+'</font>'); 
					}
				}
			});
		}
	});
	
    $('#send_ajax').click(function (){
		var username = $('#input1').val();
		var age = $('#input2').val();
		if (username == '') {
			$('#contentdiv_a').css('margin-top','-12px').html('<font color="#87CEFA">帐号不能为空</font>');  
			return false;
		}
		if (age == '') {
			$('#contentdiv_a').css('margin-top','-12px').html('<font color="#87CEFA">密码不能为空</font>');   
			return false;
		}
		var params = $('#formtest').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=login',
			type:'post', 
			dataType:'json', 
			data:params, 
			success:function(data){
				update_page(data);
                $('#content').length ? setTimeout(function(){$.pjax.reload('#content',{fragment:'#content',timeout:6000})},0):'';
				if(data.code=='200'){
					location.reload();
				}
			}
			//$('#contentdiv_a').html('<p color="#87CEFA">login....</p>');		
		});
	update_page(1);
	});
    $('#re_ajax').click(function (){
		var usrName = $("input[name=reusername]").val().replace(/(^\s*)|(\s*$)/g, "");
		var eml = $("input[name=regemail]").val().replace(/(^\s*)|(\s*$)/g, "");
		var pwd = $("input[name=repassword]").val().replace(/(^\s*)|(\s*$)/g, "");
		var pwd2 = $("input[name=repassword2]").val().replace(/(^\s*)|(\s*$)/g, "");
		var yzm = $("input[name=reimgcode]").val().replace(/(^\s*)|(\s*$)/g, "");		
		if(usrName.length>12 || pwd.length>12){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">用户名和密码都不能>12位</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		if(usrName.match(/\s/) || pwd.match(/\s/)){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">用户名和密码中不能有空格</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		if(usrName == '' || pwd == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">用户名或密码不能为空</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		 if(yzm == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">验证码都不能为空</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			 return false;
		 }
		if(usrName.length < 5 || pwd.length < 5){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">用户名和密码都不能小于5位</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		if(pwd != pwd2){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">两次输入密码不相等</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		var params = $('#refrom').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=re',
			type:'post',
			dataType:'json',
			data:params,
			success:re_page
		});
		$('#contentdiv_b').html('<font color="#87CEFA">login.....</font>');
	});
});
function qq_login_ok(type) {
	if(type == 1){
		window.location.reload();
	}else{
		$.ajax({
			url:metatheme + 'inc/ajax.php?a=ajax',
			type:'post', 
			dataType:'json', 
			success:update_page
		});
	}
}


function update_page(json) {
	if(json==1){
	   $('#contentdiv_a').css('margin-top','-12px').html('<font color="#87CEFA">login.........</font>');
   }
   if(json.code=='200'){
		$('.modal').modal('hide');						
		$('.login-nav').hide();
		$('.logout-nav').show();
		$('.login-nav').hide();
		$('.logout-nav').show();
		$('#myLogin').hide();
	}else if(json.code=='201' || json.code=='202' || json.code=='203'){
		$('#code').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_a').css('margin-top','-12px').html('<font color="#87CEFA">' + json.info + '</font>');
	}
}
function re_page(json) {
   if(json.code=='200'){
		$('#contentdiv_b').html('<font color="#87CEFA">' + json.info + '</font>');
		setTimeout(function () {$('.rbtn').val("");$('#contentdiv_b').html("")},500);
		setTimeout(function () {$('.sign-reg').hide();$('.sign-login').show()},800);
		$('#code').attr('src','/include/lib/checkcode.php');
	}else{
		$('#recode').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_b').css('margin-top','-12px').html('<font color="#87CEFA">' + json.info + '</font>');
	}
}
</script>
<?php if($is_gslogin){ ?>
<script>
	$(".ljdl,.wjmm,.ljzc,.closea,.close").click(function() {
		clearTimeout(interval1);
	});
	$(".smdl").click(function() {
		qqlogin()
	});
	var interval1;
	function qqlogin(){

		$('#contentdiv_c').html("请稍等");
		getqrpic();
		interval1=setInterval(autologin,1000);
	}	
	function getqrpic(){
		var getvcurl='/?plugin=gslogin&do=qrcode&r='+Math.random(1);
		$.get(getvcurl, function(d) {
			if(d.saveOK ==0){
				$('#picdiv').attr('qrsig',d.qrsig);
				$('#picdiv').html('<img onclick="autologin()" src="data:image/png;base64,'+d.data+'" style="width:100%;height:auto" title="点击刷新">');
				$('#contentdiv_c').html("请使用手机QQ扫码");
			}else{
				alert(d.msg);
			}
		});
	}
	function autologin(){
		var qrsig=$('#picdiv').attr('qrsig');
		var c = c || "/?plugin=gslogin&do=qrlogin&qrsig="+decodeURIComponent(qrsig)+"&r=" + Math.random(1);
		$.post(c,{},function(result){
			var msg='请扫描二维码';
			switch(result.code){
				case '0':
					msg = result.data;
					clearTimeout(interval1);
					setTimeout(function(){
						window.location.href="/admin/index.php";
					},2000);
					break;
				case '-1':
					$('#contentdiv_c').html("您未被授权登陆,请联系管理员");
					clearTimeout(interval1);
					break;
				case '1':
					getqrpic();
					$('#contentdiv_c').html("请重新扫描二维码");
					break;
				case '2':
					$('#contentdiv_c').html("请使用手机QQ扫码");
					break;
				case '3':
					$('#contentdiv_c').html("扫码成功,请在手机上确认登陆");
					break;
				default:
					break;
			}
			$('#contentdiv_c').html(msg);
		});
	}
</script>
<?php } ?>