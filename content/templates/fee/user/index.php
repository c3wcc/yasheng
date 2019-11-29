<?php
/**
 * 自建页面模板--会员中心
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(ROLE == 'admin' || ROLE == 'writer'):
$user_cache = $CACHE->readCache('user');
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';
/*会员中心-个人资料获取*/
$DB = Database::getInstance();
$userData = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."user WHERE uid = '".UID."'");
$userData['username'] = htmlspecialchars($userData['username']);
$userinfo = LoginAuth::getUserDataByLogin($userData['username']);
/**
 * 分页函数
 *
 * @param int $count 条目总数
 * @param int $perlogs 每页显示条数目
 * @param int $page 当前页码
 * @param string $url 页码的地址
 */
function paginations($count, $perlogs, $page, $url, $anchor = ''){
	$pnums = @ceil($count / $perlogs);
	$re = '';
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|", "", $url);
	for ($i = $page - 5; $i <= $page + 5 && $i < $pnums; $i++) {
		if ($i >= 0) {
			if ($i == $page) {
				$re .= "<li class=\"active\"><span>".($i+1)."</span></li>";
			} elseif ($i == 0) {
				$re .= "<li><a href=\"$urlHome$anchor\">".($i+1)."</a></li>";
			} else {
				$re .= "<li><a href=\"$url$i$anchor\">".($i+1)."</a></li>";
			}
		}
	}
	if ($page > 6)
		$re = "<li><a href=\"{$urlHome}$anchor\" title=\"首页\">首页</a></li>$re";
	if ($page + 5 <= $pnums)
		$re .= "<li><a href=\"$url".($pnums-1)."$anchor\" title=\"尾页\">尾页</a></li>";
	if ($pnums <= 0)
		$re = '';
	return $re;
}
//获取用户发表文章
function myblog(){
		$DB = Database::getInstance();
		global $userData;
		$userid = $userData['uid'];
		$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
		$sizepage = 7;
		$limit = $page*$sizepage;
		$numsql = "select count(*) from ".DB_PREFIX."blog where author=$userid";
		$res = $DB->query($numsql);
		$myblognum = $DB->fetch_array($res);
		$numsql = "select gid,title,views,comnum,hide,author,date,checked from ".DB_PREFIX."blog where author=$userid order by gid desc limit $limit,$sizepage";
		$res = $DB->query($numsql);
		$f.='<div class="user-main">
	<ul class="user-postlist">';
		while ($myblog = $DB->fetch_array($res)) {
			$hide = $myblog['checked']=='n'?' <span style="color:red;">(待审核)</span>':'(已审核)';
			$hidetitle = $myblog['hide']=='y'?' '.$myblog['title']:''.$myblog['title'].'';
			$hidetitlewz = $myblog['hide']=='y'?' '.$myblog['title']:''.Url::log($myblog['gid']).'';
			$hideviews = $myblog['hide']=='y'?' '.$myblog['views']:''.$myblog['views'].'';
			$hidecomnum = $myblog['hide']=='y'?' '.$myblog['comnum']:''.$myblog['comnum'].'';
			$date=date("Y-m-d H:i:s",$myblog["date"]); 
			$f.="
			<li>
		<h2><a title='$hidetitle' target='_blank' href='$hidetitlewz'>$hidetitle</a>$hide</h2>

		<p class='text-muted'>
			$date &nbsp;&nbsp; &nbsp;&nbsp; 阅读($hideviews) &nbsp;&nbsp; 评论($hidecomnum) &nbsp;&nbsp; 
		</p>
		</li>			
            ";
		}
		$f.='	</ul>
</div>';
		$f.= '<div class="pagination"><ul>'.paginations($myblognum['count(*)'],$sizepage, $page, BLOG_URL."?user&posts&page=").'</ul></div>';
		if($myblognum==0){
			return '您还没有发表过文章哦!';
		}else{
			return $f;
		}
	}

//获取用户发表评论
function mycomment(){
		$DB = Database::getInstance();
		global $userData;
		$userEmail = $userData['email'];
		$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
		$sizepage = 5;
		$limit = $page*$sizepage;
		$numsql = "select count(*) from ".DB_PREFIX."comment where mail='$userEmail'";
		$res = $DB->query($numsql);
		$myblognum = $DB->fetch_array($res);
		$numsql = "select * from ".DB_PREFIX."comment where mail='$userEmail' order by date desc limit $limit,$sizepage";
		$res = $DB->query($numsql);
		$f.='';
		while ($myblog = $DB->fetch_array($res)) {
			//$hide = $myblog['hide']=='y'?'(<span style="color:red;">待审核</span>)':'(已审核)';
			//根据ID获取标题
				$sql = "select gid,title from ".DB_PREFIX."blog where gid={$myblog['gid']} ";
				$re = $DB->query($sql);
				$title = $DB->fetch_array($re);
			$hidetitle = '<a href="'.Url::log($myblog['gid']).'" target="_blank">'.$title["title"].'</a>';
			
			$content=$myblog["comment"];
			$date=date("Y-m-d H:i:s",$myblog["date"]); 
			$f.="
<div class='user-default'>
  <div class='panel-heading'>评论于$hidetitle</div>
  <div class='panel-body'>$content</div>
  <div class='panel-footer'>$date</div>
</div>
		 ";
		}
		$f.= '<div class="pagination"><ul>'.paginations($myblognum['count(*)'],$sizepage, $page, BLOG_URL."?user&comments&page=").'</ul></div>';
    	if($userEmail==""){
        	return '您需要设置邮箱之后才能查看评论!';
        }
		if($myblognum==0){
			return '您还没有发表过评论哦!';
		}else{
			return $f;
		}
	}
global $userData;
$data=_vip(UID);
?>
<div id="<?php echo get_template_name();?>">
<div class="usertitle" style="background-image: url(https://cy-pic.kuaizhan.com/g3/ac/71/4dc8-80b8-40c0-9600-9d30118b967a24);">
	<section class="container">
	<img src="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-100" height="50" width="50">
	<h2><?php echo htmlspecialchars($userinfo['nickname']); ?> <span>账号：<?php echo htmlspecialchars($userinfo['username']); ?></span></h2>
	<p>
	</p>
	</section>
</div>
<section class="container">
	<div class="contents">
	<link type="text/css" href="/content/templates/fee/static/css/user.css" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
	<div class="container-user">
		<div class="userside">
	<div class="usermenus">
			<ul class="usermenu">
				<li class="usermenu-index"><a href="?user&home"><i class="fa fa-dashboard"></i> 用户中心</a></li>
                <li class="/tg"><a href="/tg"><i class="fa fa-globe"></i> 投稿须知</a></li>
				<li class="usermenu-post-new"><a href="?user&log"><i class="fa fa-pencil-square-o"></i> 发布文章</a></li>
				<li class="usermenu-posts"><a href="?user&posts"><i class="fa fa-file-word-o"></i> 我的文章</a></li>
				<li class="usermenu-comments"><a href="?user&comments"><i class="fa fa-comments"></i> 我的评论</a></li>
				<li class="usermenu-info"><a href="?user&datas"><i class="fa fa-cogs"></i> 修改资料</a></li>
				<!--<li class="usermenu-password"><a href="#password"><i class="fa fa-lock"></i> 修改密码</a></li>-->
				<?php if(ROLE == ROLE_ADMIN){?>
				<li class="usermenu-info"><a href="?setting"><i class="fa fa-desktop"></i> 模板设置</a></li>
				<?php }?>
				<li class="usermenu-signout"><a href="?user&logout"><i class="fa fa-sign-in fa-flip-horizontal"></i> 退出</a></li>
			</ul>
		</div>
	</div>
		<?php if(isset($_GET['home'])):?>
		<div class="content" id="contentframe">
	<div class="user-main" style="display: block;">
		<div class="row">
			<div class="col-xl-4 col-sm-4 mb-4">
				<div class="user-card bg-primary">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-cogs"></i>
						</div>
						<div class="mr-5">
							个人资料
						</div>
					</div>
					<a class="card-footer" href="?user&datas">
					<span class="float-left">修改资料</span>
					<span class="float-right">
					<i class="fa fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
			<div class="col-xl-4 col-sm-4 mb-4">
				<div class="user-card bg-warning">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-comments"></i>
						</div>
						<div class="mr-5">
							我的评论
						</div>
					</div>
					<a class="card-footer" href="?user&comments">
					<span class="float-left">查看详情</span>
					<span class="float-right">
					<i class="fa fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
			<div class="col-xl-4 col-sm-4 mb-4">
				<div class="user-card bg-success">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-pencil-square-o"></i>
						</div>
						<div class="mr-5">
							我的文章
						</div>
					</div>
					<a class="card-footer" href="?user&posts">
					<span class="float-left">查看详情</span>
					<span class="float-right">
					<i class="fa fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
		</div>
		<section class="author-card">
		<div class="inner">
			<img src="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-100" height="50" width="50">
			<div class="card-text">
				<div class="display-name">
					<?php echo htmlspecialchars($userinfo['username']); ?>
				</div>
			</div>
		</div>
		</section>
		<section class="info-basis">
		<header>
		<h2>基本信息</h2>
		</header>
		<div class="info-group clearfix">
			<label class="col-md-1 control-label">昵称</label>
			<p class="col-md-11">
				<?php echo htmlspecialchars($userinfo['nickname']); ?>
			</p>
		</div>
		<div class="info-group clearfix">
			<label class="col-md-1 control-label">邮箱</label>
			<p class="col-md-11">
				<?php echo htmlspecialchars($userinfo['email']); ?>
			</p>
		</div>
		<div class="info-group clearfix">
			<label class="col-md-1 control-label">主页</label>
			<p class="col-md-11">
				<?php echo BLOG_URL.'author/'.UID ?>
			</p>
		</div>
		<div class="info-group clearfix">
			<label class="col-md-1 control-label">个人描述</label>
			<p class="col-md-11">
			<?php echo htmlspecialchars($userinfo['description']); ?>
			</p>
		</div>
		</section>
	</div>
	<div class="user-tips">
	</div>
</div>
		<?php endif;if(isset($_GET['log'])):?>
		<div class="content" id="contentframe">
	<div class="user-main" style="display: none;">
	</div>
	<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>提示：文章作品需提交审核通过才能正式发布，请耐心等待。</span>
				</div>
				<form action="" method="post" name="addlog" id="addlog" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-sm-12 form-post"><input type="text" class="form-control regular-text large" name="post_title" placeholder="文章标题"></div>
						<div class="col-sm-12 form-post"><textarea id="editor_content" name="content" style="width:100%; height:560px;" class="form-control"><?php echo $content; ?></textarea>
							<script>tinymce.init({selector:'#editor_content',language:'zh_CN',elementpath: false,height:300,menubar: false,  plugins: "image"})</script>
						</div>
						<div class="col-sm-3"><select name="post_category" id="post-cat" class="col-lg-3 form-control">
							<?php
								global $CACHE;
								$sort = $CACHE->readCache('sort');
								$blogsort = '';
								$blogsort .= '<option value="-1">选择分类</option>';
								foreach ($sort as $value) {
									$blogsort .= '<option class="level-1" value="'.$value['sid'].'">'.$value['sortname'].'</option>';
								}
								$blogsort .= '';
								echo $blogsort;
							?>
						</select></div>
						<div class="col-sm-5"><span class="spinner"></span></div>
						<div class="col-sm-4"><input type="button" id="postnew" class="btn btn-blue pull-right" name="submit" value="投稿"></div>
					</div>
				</form>
			</div>
</div>
		<?php endif;if(isset($_GET['comments'])):?>
		<div class="content" id="contentframe">
	<div class="user-main" style="display: none;">
	</div>
			<section class="panel panel-default">
			<div class="panel-heading">评论管理</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>提示：认真填写的点评都有可能被推荐为精彩评论哦。</span>
				</div>
				<div class='user-commbody'>
				<?php echo mycomment();?>
				</div>
			</div>
			</section>
		</div>
		<?php endif;if(isset($_GET['posts'])):?>
		<div class="content" id="contentframe">
		<?php echo myblog();?>
		</div>
		
		<?php endif;if(isset($_GET['datas'])):?>
		<div class="content" id="contentframe">
	<div class="user-main" style="display: none;">
	</div>
		<ul class="user-meta">
			<form action="" method="post" name="blooger" class="form-horizontal" id="updatefrom" enctype="multipart/form-data">
			<li><label>登录账号</label>
				<input type="text" name="username" id="username" value="<?php echo htmlspecialchars($userinfo['username']); ?>" class="form-control" disabled="disabled">
			</li>
			<li><label>个人主页</label>
				<input type="text" name="zhuye" id="zhuye" value="<?php echo BLOG_URL.'author/'.UID ?>" class="form-control" disabled="disabled">
			</li>
			<li><label>我的昵称</label>
				<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($userinfo['nickname']); ?>" class="form-control form-xg" disabled="disabled">
			</li>
			<li><label>邮箱号码</label>
				<input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userinfo['email']); ?>" class="form-control form-xg" disabled="disabled">
			</li>
			<li><label>QQ 号码</label>
				<input type="text" name="qq" id="qq" value="<?php echo htmlspecialchars($userinfo['qq']); ?>" class="form-control form-xg" disabled="disabled">
			</li>
			<?php if($Tconfig["qq_login"]== 1){?>
			<li><label>QQ 登录</label>	
					<?php if ($userinfo['qq_login_openid'] == ''){ ?>
					<button id="qq_login" class="btn btn-blue" type="button"><i class="fa fa-qq"></i> 立即绑定</button>
					<button style="display:none"  id="qq_login_jiebang" class="btn btn-red" type="button"><i class="fa fa-qq"></i> 解除绑定</button>
					<?php }else{ ?>
					<button style="display:none" id="qq_login" class="btn btn-blue" type="button"><i class="fa fa-qq"></i> 立即绑定</button>
					<button  id="qq_login_jiebang" class="btn btn-red" type="button"><i class="fa fa-qq"></i> 解除绑定</button>
					<?php }?>	
			</li>
			<?php }?>
			<div class="hide-ps" style="display: none;">
				<li><label>新的密码</label>
					<input type="password" name="newpass" id="newpass" value="" class="form-control">
				</li>
				<li><label>确认密码</label>
					<input type="text" name="repeatpass" id="repeatpass" value="" class="form-control">
					<ul style="display: block;">
						<li style="display: list-item;">请检查两次输入的密码是否一样.</li>
					</ul>
				</li>
			</div>
			<li><label>我的描述</label>
				<textarea placeholder="" rows="2" cols="30" class="form-control form-xg" name="description" id="description" disabled="disabled"><?php echo htmlspecialchars($userinfo['description']); ?></textarea>
			</li>
			<div class="tijiao-token">
				<div id="contentdiv_c">
				</div>
				<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden">
				<span class="xgzl" style="display: inline-block;">修改资料</span>
				<input type="submit" id="update-submit" class="hide-xg" value="立即提交" style="display: none;">
				<span class="hide-xg qxxg" style="display: none;">取消修改</span>
			</div>
		</form>
	</ul>
</div>
		<?php 
		elseif(isset($_GET['logout'])):
		setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
		emDirect(BLOG_URL);
		endif;
		?>
	</div>
</div>
</section>
<?php
/**
 * 自建页面模板--会员中心
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<script>
		$(".xgzl").on('click',function(){
		$(".form-xg").attr("disabled",false);  
		$(".hide-xg,.hide-ps").show();
		$(".fasex").hide();
		$(this).hide();
	});
	$(".qxxg").on('click',function(){
		$(".form-xg").attr("disabled","disabled");  
		$(".hide-xg,.hide-ps").hide();
		$(".xgzl,.fasex").show();
	});
$("#wx_pay").on('click',function(){
	$(".wxpay").show();
	$(".alipay").hide();
});	
$("#ali_pay").on('click',function(){
	$(".alipay").show();
	$(".wxpay").hide();
});	


//new

	$('#user_vip').on('click',function(){
		$('#user_vip').attr('disabled','disabled');
		$.ajax({
			url:metatheme + 'inc/ajax.php?a=vipxf',
			type:'post',
			dataType:'json',
			success:ajax_update
		});
	});
	$('#user_novip').on('click',function(){
		$('#user_novip').attr('disabled','disabled');
		$.ajax({
			url:metatheme + 'inc/ajax.php?a=openvip',
			type:'post',
			dataType:'json',
			success:ajax_update
		});
	});


$('.zdy_img').on('click',function(){
	$('.up_img_tips').fadeIn();
	$('.up_img_tips').fadeOut(2000);
});
$('.up_img_div').on('click',function(){
	var id = $(this).attr("data-id");
	var url= pjaxtheme + 'inc/ajax.php?a=selectimage';
	$.ajax( {  
			url:url,  
			dataType:'json',  
			type: "POST",  
			data: {"image":id},  
			success: function(data){
				if(data.result=="ok"){
					$("#up-img-touch img").attr("src",data.file);
					var img_name=data.file.split('/')[2];
					console.log(img_name);
					$("#pic").text(img_name);
				}
				swal("温馨提示!", "修改成功", "success");
				$(".modal-backdrop").remove();
				$("body").removeClass('modal-open');
				$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });
			},
			error: function(){
				//set_alert_info("修改失败");
				swal("温馨提示!", "修改失败", "error");
			}  
	 }); 
});	
function bangdingok(){
	$('#qq_login').hide();$('#qq_login_jiebang').show();
}
$('#qq_login').on('click',function(){
		window.open(pjaxtheme + "inc/ajax.php?a=qq_bangding", "qq_bangding", "top=200,left=200,height=600, width=800, toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
});
$('#qq_login_jiebang').on('click',function(){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=jie_bang',
		type:'post',
		dataType:'json',
		data:{},
		success:function (data){
			if(data.code=='200'){
				$('#qq_login').show();$('#qq_login_jiebang').hide();
			}
		}
	});
});	
$('.payvip').on("click",function(){
	var key = $("#paykey").val();
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"payvip",key:key},
		success:function (data){
			if(data.code=='200'){
				$('#pay-success').css('display','block');
				$('.pay_info').html(data.data);
				setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 1000);
			}else{
				$('#pay-danger').css('display','block');
				$('.pay_info').html(data.data)
				setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 1000);
			}
		}
	});
});
$('.log_del').on("click",function(){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"dellog"},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
			setTimeout(function () {$("li[role='presentation']:eq(2)").addClass('active').siblings().removeClass('active');}, 900);
			setTimeout(function () {$("div[role='tabpanel']:eq(3)").addClass('active in').siblings().removeClass('active in');}, 900);
		}
	});
});
$('.key_del').on("click",function(){
	var id = $(this).attr("data");
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"delkey",id:id},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
			setTimeout(function () {$("li[role='presentation']:eq(1)").addClass('active').siblings().removeClass('active');}, 900);
			setTimeout(function () {$("div[role='tabpanel']:eq(2)").addClass('active in').siblings().removeClass('active in');}, 900);
		}
	});
});
$('.input-kami').on("click",function(){
	var time = $("#kamitime").val();
	var num = $("#kaminum").val();
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"addkey",time:time,num:num},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment:pjax_id,timeout: 8000 });}, 800);
			setTimeout(function () {$("li[role='presentation']:eq(1)").addClass('active').siblings().removeClass('active');}, 900);
			setTimeout(function () {$("div[role='tabpanel']:eq(2)").addClass('active in').siblings().removeClass('active in');}, 900);
		}
	});
});
$('.addvip').on("click",function(){
	var uid = $(this).attr("data-uid");
	var time = $(this).attr("data-time");
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"addvip",uid:uid,time:time},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
		}
	});
});
$('.vipbtn').on("click",function(){
	var vip = $(this).attr("data");
		if(vip == 1){
			$(this).attr("data","0");
			$(this).attr("src",pjaxtheme + "static/img/vipoff.png");
			xiugaivip($(this).attr("userid"),"offvip");
		}else{
			$(this).attr("data","1");
			$(this).attr("src",pjaxtheme + "static/img/vipopen.png");
			xiugaivip($(this).attr("userid"),"openvip");
		}
});
$('.vip-xf').on("click",function(){
	var Integral = $(this).attr("data-xf");
	var msg = "操作确认？";  
    if (confirm(msg)==false) return false;
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:'payviptime',sort:Integral},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
		}
	});
});
function xiugaivip (userid,isopen){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{uid:userid,type:isopen},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
		}
	});
}
$(document).ready(function(){
    $('#update-submit').click(function (){
		var username = $("input[name=username]").val().replace(/(^\s*)|(\s*$)/g, "");
		var name = $("input[name=name]").val().replace(/(^\s*)|(\s*$)/g, "");
		var qq = $("input[name=qq]").val().replace(/(^\s*)|(\s*$)/g, "");
		var email = $("input[name=email]").val().replace(/(^\s*)|(\s*$)/g, "");
		//var sex = $("input[name=sex]").val().replace(/(^\s*)|(\s*$)/g, "");
		var description = $("textarea[name=description]").val().replace(/(^\s*)|(\s*$)/g, "");
		var nwp = $("input[name=newpass]").val().replace(/(^\s*)|(\s*$)/g, "");
		var rewp = $("input[name=repeatpass]").val().replace(/(^\s*)|(\s*$)/g, "");
		var params = $('#updatefrom').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=update',
		type:'post',
			dataType:'json',
			data:params,
			success:ajax_update
		});
		return false;
	});
});

$(document).ready(function(){
    $('#postnew').click(function (){
		var title = $("input[name=post_title]").val().replace(/(^\s*)|(\s*$)/g, "");
		var content = tinyMCE.get('editor_content').getContent();
		var category = $("select[name=post_category]").val().replace(/(^\s*)|(\s*$)/g, "");
			$.ajax({
				type: 'POST',
				url: pjaxtheme + 'inc/ajax.php?a=addlog',
				data: "post_title="+ title + "&post_content=" + content + "&post_category=" + category,
				dataType: 'json',
				success: ajax_addlog
			});
		return false;
	});
});
function ajax_addlog(json) {
//	$('.spinner').html('<font color="red">' + json.info + '</font>');
swal("温馨提示!", ""+json.info+"", "success");
	if(json.code=='200'){
		setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 500);
	}
}
function ajax_update(json) {
		//$.message({ message:'' + json.info + '', type:'fa fa-times c-message--error'});;
		if(json.code=='200'){	
			swal("温馨提示!", ""+json.info+"", "sucess");

			//$.message('' + json.info + '');
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 500);
		}else{
			swal("温馨提示!", ""+json.info+"", "error");
		}
	}
	
	
$(function() {
    'use strict';
    var $image = $('#image');
    $image.cropper({
        aspectRatio: '1',
        autoCropArea:0.8,
        preview: '.up-pre-after',
        
    });
    
    var $inputImage = $('#inputImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            var files = this.files;
            var file;

            if (files && files.length) {
               file = files[0];

               if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                       URL.revokeObjectURL(blobURL);
                    }).cropper('reset').cropper('replace', blobURL);
                    $inputImage.val('');
                } else {
                    window.alert('Please choose an image file.');
                }
            }

            var fileNames = '';
            $.each(this.files, function() {
                fileNames += '<span class="am-badge">' + this.name + '</span> ';
            });
            $('#file-list').html(fileNames);
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
    $('#up-btn-ok').on('click',function(){
    	var img_src=$image.attr("src");
    	if(img_src==""){
			swal("温馨提示!", "没有选择上传的图片", "error");
    		//set_alert_info("没有选择上传的图片");
    		return false;
    	}
    	
    	var url= pjaxtheme + 'inc/ajax.php?a=upimage';
    	var canvas=$("#image").cropper('getCroppedCanvas');
    	var data=canvas.toDataURL();
        $.ajax( {  
                url:url,  
                dataType:'json',  
                type: "POST",  
                data: {"image":data.toString()},  
                success: function(data, textStatus){
                	if(data.result=="ok"){
                		$("#up-img-touch img").attr("src",data.file);
                		var img_name=data.file.split('/')[2];
                		console.log(img_name);
                		$("#pic").text(img_name);
                	}
					swal("温馨提示!", "头像上传成功！", "success");
					$(".modal-backdrop").remove();
					$("body").removeClass('modal-open');
					$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });
                },
                error: function(){
					swal("温馨提示!", "上传文件失败了！", "error");
                	//set_alert_info("上传文件失败了！");
                }  
         });  
    	
    });
    
});
$('.vip_zdy').on('click',function(){
	$(".up-frame-body").show();$('.up_img_body').hide();
});

function imgdefault() {
$(".up_img_body").show();$('.up-frame-body').hide();
}

function rotateimgright() {
$("#image").cropper('rotate', 90);
}

function rotateimgleft() {
$("#image").cropper('rotate', -90);
}

function set_alert_info(content){
	$(".up-tips").html(content);
}

		$('#refund_btn').click(function (){
			money  = $('#money').val();
			var str ="金额错误";
			note = $('#note').val();
			swal("温馨提示!", ""+str+"", "error");
			$.message({ message:'两次输入密码不相等', type:'fa fa-times c-message--error'});
			return false;
		});


</script>
  </div>
<?php
include View::getView('footer');
else:
emDirect(BLOG_URL);
endif;
?>