<?php 
/**
 * 登陆页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
$is_gslogin = is_file(EMLOG_ROOT.'/content/plugins/gslogin/gslogin.php') ? true : false;
?>
<div class="modal fade" id="myLogin" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="sign-login">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h3 class="sign-title">用户登陆</h3>
					</div>
					<div class="clearfix"></div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-7 ajax_login_list1">
									<form id="formtest" action="" method="post">
											<div class="input-group input-login">
												<span class="input-group-addon"><i class="fa fa-user faw"></i></span>
												<input class="form-control lbtn" placeholder="请输入用户名" id="input1" name="user" type="text" value=""/>
											</div>
											<div class="input-group input-login">
												<span class="input-group-addon"><i class="fa fa-lock faw"></i></span>
												<input class="form-control lbtn" placeholder="请输入密码" id="input2"name="pw" type="password" value=""/>
											</div>
											<?php if(Option::get('login_code') == 'y'){ ?>
											<div class="input-group input-login">
												<span class="input-group-addon"><i class="fa fa-file-code-o faw"></i></span>
												<input class="form-control lbtn" placeholder="请填写验证码" id="imgcode" name="imgcode" type="text" value=""/>
												<span class="ajax_reg_imgcode imgcode"><img src="/include/lib/checkcode.php" id="code"/></span>
											</div>
											<?php };?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ispersis" id="ispersis" class="mgc mgc-info" value="1" title="7天免登陆" /> 记住密码
												</label>
												<span style="float:right">
													<a href="javascript:;" class="wjmm">忘记密码?</a>							
												</span>
												<div class="clearfix"></div>
											</div>
									</form>
											<div id="contentdiv_a" style="text-align: center;"></div>
											<div class="form-group">
												<input type="submit" name="send_ajax" id="send_ajax" value="用户登陆" class="btn ajax_reg_btn btn-block">
											</div>
								</div>
								<div class="col-sm-5 ajax_login_list2">
											<div class="form-group">
												<p>还没有账号?</p>								
											</div>
											<div class="form-group">
												<input type="submit" value="<?php if($Tconfig["regopen"]== 2 ){echo '暂不开放';}else{echo '立即';};?>注册" class="btn ajax_reg_btn btn-block ljzc" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>>
											</div>
											<div class="form-group">
												<p>您还可以使用其他方式登陆</p>								
											</div>
											<div class="form-group input-login">
												<?php if($Tconfig["qq_login"]== 1){?>
												<span><a href="javascript:;" class="ajax_qq_login ajax_login_icon" title="QQ登陆"><span class="fa fa-qq"></span></a></span>
												<?php }?>
												<?php if($is_gslogin){ ?>
												<span><a href="javascript:;" class="ajax_login_code smdl" title="扫码登陆"><span class="fa fa fa-qrcode"></span></a></span>
												<?php }?>
											</div>
											<?php if(Option::get('login_code') == 'y'){ ?>
											<div class="form-group">
												<p>请珍惜本站账号,一经发现账号共享,取消VIP资格.</p>								
											</div>
											<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
		        <div class="sign-reg" style="display:none">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h3 class="sign-title">注册账号</h3>
					</div>
					<div class="clearfix"></div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
							<div class="col-sm-7 ajax_login_list1">
							<form id="refrom" action="" method="post">
									<div class="input-group input-reg">
										<span class="input-group-addon"><i class="fa fa-user faw"></i></span>
										<input class="form-control rbtn" placeholder="请输入用户名" name="reusername" type="text" value="" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
									</div>
									<div class="input-group input-reg">
										<span class="input-group-addon"><i class="fa fa-envelope-o faw"></i></span>
										<input class="form-control rbtn" placeholder="请输入邮箱" name="regemail" type="email" value="" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
									</div>
									<div class="input-group input-reg">
										<span class="input-group-addon"><i class="fa fa-lock faw"></i></span>
										<input class="form-control rbtn" placeholder="请输入密码" name="repassword" type="password" value="" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
									</div>
									<div class="input-group input-reg">
										<span class="input-group-addon"><i class="fa fa-check faw"></i></span>
										<input class="form-control rbtn" placeholder="请确认密码" name="repassword2" type="password" value="" <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
									</div>						
							</form>
								<div id="contentdiv_b" style="text-align: center;"></div>
								<div class="form-group">
									<input type="submit" name="re_ajax" id="re_ajax" value="<?php if($Tconfig["regopen"]== 2 ){echo '暂不开放';}else{echo '立即';};?>注册" class="ajax_reg_btn btn_go form-control"  <?php if($Tconfig["regopen"]== 2 ){echo 'disabled="disabled"';}?>/>
								</div>
							</div>
							<div class="col-sm-5 ajax_login_list2">
								<div class="form-group">
									<p>已有账号?</p>								
								</div>
								<div class="form-group">
									<input type="submit" value="立即登陆" class="btn ajax_reg_btn btn-block ljdl">
								</div>
								<div class="form-group">
									<p>您还可以使用其他方式登陆</p>								
								</div>
								<div class="form-group input-login">
									<?php if($Tconfig["qq_login"]== 1){?>
									<span><a href="javascript:;" class="ajax_qq_login ajax_login_icon" title="QQ登陆"><span class="fa fa-qq"></span></a></span>
									<?php }?>
									<?php if($is_gslogin){ ?>
									<span><a href="javascript:;" class="ajax_login_code smdl" title="扫码登陆"><span class="fa fa fa-qrcode"></span></a></span>
									<?php }?>
								</div>
								<div class="form-group">
									<p>请珍惜本站账号,一经发现账号共享,取消VIP资格.</p>								
								</div>
							</div>
						</div>
					</div>
		        </div>
				</div>
				
				<div class="sign-zhaohui" style="display:none">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h3 class="sign-title">密码找回</h3>
					</div>
					<div class="clearfix"></div>
					<div class="modal-body">
						<div class="row">
						<div class="col-sm-7 ajax_login_list1">
						<div class="container-fluid">
							<form id="formtest" action="" method="post">
									<div class="input-group input-email">
										<span class="input-group-addon"><i class="fa fa-retweet faw"></i></span>
										<input class="form-control lbtn" placeholder="请输入邮箱" id="reemail" name="email" type="email" value=""/>
									</div>
							</form>
							<div id="contentdiv_t" style="text-align: center;"></div>
							<div class="form-group ajax_btn-reg">
								<span><input type="submit" name="pwre_ajax" id="pwre_ajax" value="找回密码" class="btn ajax_reg_btn btn-block"/></span>
							</div>
						</div>
						</div>
						<div class="col-sm-5 ajax_login_list2">
							<div class="form-group">
								<p>密码已找回?</p>								
							</div>
							<div class="form-group">
								<input type="submit" value="立即登陆" class="btn ajax_reg_btn btn-block ljdl">
							</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="sign-saomiao" style="display:none">
					<div class="saomiao-close">扫描登陆<a href="javascript:;" class="closea" title="关闭"></a></div>
					<div id="picdiv" style="margin:-15px"></div>
					<div id="contentdiv_c" style="text-align:center;color:red"></div>
					<div class="clearfix"></div>
				</div>
		</div>
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
			$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="red">邮箱不能为空</font>'); 
		}else if(!isxemail.test(xemail)){
			$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="red">邮箱格式不正确</font>'); 
		}else{
			$.ajax({
				url:pjaxtheme + 'inc/pwre.php',
				type:'post', 
				dataType:'json', 
				data:{email:xemail}, 
				success:function(data){
					if (data.status=='1') {
						$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="red">该邮箱尚未注册</font>'); 
					}else{
						$('#contentdiv_t').css('margin-bottom','-12px').html('<font color="red">'+data.msg+'</font>'); 
					}
				}
			});
		}
	});
	
    $('#send_ajax').click(function (){
		var username = $('#input1').val();
		var age = $('#input2').val();
		if (username == '') {
			$('#contentdiv_a').css('margin-top','-12px').html('<font color="red">帐号不能为空</font>');  
			return false;
		}
		if (age == '') {
			$('#contentdiv_a').css('margin-top','-12px').html('<font color="red">密码不能为空</font>');  
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
				if (data.data.photo ==''){
					swal({   title: "你还未设置头像?",   text: "前往个人资料设置头像,做个有头有脸的人吧!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "马上去",   cancelButtonText: "滚犊子",   closeOnConfirm: false }, function(){window.location.href= blog_url + '?user&datas';});
				};
			}
		});
	});
    $('.send-code').click(function (){
    	if($(this).html() == '已发送') return false;
    	if($("input[name=regemail]").val() == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">请输入邮箱</font>');
			return false;
    	}
		$.ajax({
			url: '<?php echo TEMPLATE_URL;?>inc/ajax.php?a=sendcode',
			type:'post',
			dataType:'json',
			data:{"code":$("input[name=reimgcode]").val(),"email":$("input[name=regemail]").val()},
			success:function(data){
				if(data.code == 200){
					$('.send-code').html("已发送");
					$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">' + data.info + '</font>');
					return false;
				}else{
					$(".form-code").attr('src','<?php echo BLOG_URL ?>include/lib/checkcode.php?'+ Math.random());
					$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">' + data.info + '</font>');
					return false;
				}
			}
		});
		return false;
	});
    $('#re_ajax').click(function (){
		var usrName = $("input[name=reusername]").val().replace(/(^\s*)|(\s*$)/g, "");
		var eml = $("input[name=regemail]").val().replace(/(^\s*)|(\s*$)/g, "");
		var pwd = $("input[name=repassword]").val().replace(/(^\s*)|(\s*$)/g, "");
		var pwd2 = $("input[name=repassword2]").val().replace(/(^\s*)|(\s*$)/g, "");
		//var yzm = $("input[name=reimgcode]").val().replace(/(^\s*)|(\s*$)/g, "");
		//var code = $("input[name=code]").val().replace(/(^\s*)|(\s*$)/g, "");
		if(usrName.match(/\s/) || pwd.match(/\s/)){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">用户名和密码中不能有空格</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		if(usrName == '' || pwd == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">用户名或密码不能为空</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		/*if(yzm == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">验证码都不能为空</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}*/
		if(usrName.length < 5 || pwd.length < 5){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">用户名和密码都不能小于5位</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		if(pwd != pwd2){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">两次输入密码不相等</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}
		/*else if(code == ''){
			$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">邮箱验证码未填写</font>'); 
			$('#recode').attr('src','/include/lib/checkcode.php');
			return false;
		}*/
		var params = $('#refrom').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=re',
			type:'post',
			dataType:'json',
			data:params,
			success:re_page
		});
	});
});
function qq_login_ok(type) {
	if(type == 1){
		window.location.reload();
	}else{
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=ajax',
			type:'post', 
			dataType:'json', 
			success:function(data){
				update_page(data);
                $('#content').length ? setTimeout(function(){$.pjax.reload('#content',{fragment:'#content',timeout:6000})},0):'';
				if (data.data.photo ==''){
					swal({   title: "你还未设置头像?",   text: "前往个人资料设置头像,做个有头有脸的人吧!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "马上去",   cancelButtonText: "滚犊子",   closeOnConfirm: false }, function(){window.location.href= blog_url + '?user&datas';});
				};
			}
		});
	}
}
function update_page(json) {
   if(json.code=='200'){
		$('.modal').modal('hide');
		var rzphoto = json.data.vip != '-1' ? 'author-idents' : 'author-identw';
		var dlnickname = json.data.nickname != '' ? json.data.nickname : '未命名';
		var dlhm = json.data.vip != '-1' ? '<div class="col-sm-12 sideli dlbt" style="color:red">' : '<div class="col-sm-12 sideli dlbt">';
		var dlphoto = json.data.photo != '' ? blog_url + json.data.photo.substring(3) : pjaxtheme +'img/avatar.png';
		if (json.data.role == 'admin') {
		$('.dlname').html('<div class="author-ident"></div>');
		$('.dlset,.lgset').html('<a href="' + blog_url + 'admin" target="_blank"><i class="fa fa-cogs"></i> 后台管理</a>');
		$('.dlcd').html('<div class="col-sm-6 sideli"><a href="' + blog_url + '?setting"><i class="fa fa-desktop"></i> 模板设置</a></div><div class="col-sm-6 sideli"><a href="' + blog_url + '?user&vip"><i class="fa fa-bullhorn"></i> 会员管理</a></div>');
		}else{
		$('.dlname').html('<div class="' + rzphoto + '"></div>');
		$('.dlset').html('<a href="' + blog_url + '?user&datas"><i class="fa fa-pencil-square-o"></i> 修改资料</a>');
		$('.lgset').html('');
		$('.dlcd').html(dlhm+ dlnickname +'</div>');
		};
		$('.dlimg').html('<a href="' + blog_url + 'author/' + json.data.uid + '"><img src="' + dlphoto + '"></a></a>');
		$('.login-nav').hide();
		$('.logout-nav').show();
		$('.login-avatars').html('<img src="' + dlphoto + '" class="login-nav-avatar">');
		$('#mobile-login').addClass('login_logout').html('<a href="'+ blog_url +'?user&home"><span><img src="' + dlphoto + '" class="login-nav-avatar"></span> 个人 </a>');
		setTimeout(function () {$('.lbtn').val("")},400);
		$('#user-login').hide();
		$('#user-div').show();
		$('#myLogin').hide();
	}else if(json.code=='201' || json.code=='202' || json.code=='203'){
		$('#code').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_a').css('margin-top','-12px').html('<font color="red">' + json.info + '</font>');
	}
}
function re_page(json) {
   if(json.code=='200'){
		$('#contentdiv_b').html('<font color="red">' + json.info + '</font>');
		setTimeout(function () {$('.rbtn').val("");$('#contentdiv_b').html("")},500);
		setTimeout(function () {$('.sign-reg').hide();$('.sign-login').show()},800);
		$('#code').attr('src','/include/lib/checkcode.php');
	}else{
		$('#recode').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_b').css('margin-top','-12px').html('<font color="red">' + json.info + '</font>');
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