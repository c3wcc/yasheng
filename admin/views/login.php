<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="robots" content="noindex, nofollow">
<title>登录页 - <?php echo Option::get('blogname'); ?></title>
<link href="./views/plugins/bootstrap-3.3.0/css/bootstrap.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet"/>
<link href="./views/plugins/material-design-iconic-font-2.2.0/css/material-design-iconic-font.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet"/>
<link href="./views/plugins/waves-0.7.5/waves.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet"/>
<link href="./views/plugins/checkbix/css/checkbix.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet"/>
<link href="./views/app/css/login.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet"/>
<style>
<?php if(Option::get('admin_style')=="admin-default"): ?>
body:before{height:50%;width:100%;position:absolute;top:0;left:0;background: #455EC5;content:"";z-index:0}
.fg-line:after{position:absolute;z-index:3;bottom:0;left:0;height:2px;width:0;content:"";-webkit-transition:all;-o-transition:all;transition:all;-webkit-transition-duration:.3s;transition-duration:.3s;background:#455EC5;}
<?php elseif(Option::get('admin_style')=="admin-pink"): ?>
body:before{height:50%;width:100%;position:absolute;top:0;left:0;background: #F06292;content:"";z-index:0}
.fg-line:after{position:absolute;z-index:3;bottom:0;left:0;height:2px;width:0;content:"";-webkit-transition:all;-o-transition:all;transition:all;-webkit-transition-duration:.3s;transition-duration:.3s;background:#F06292;}
<?php elseif(Option::get('admin_style')=="admin-purple"): ?>
body:before{height:50%;width:100%;position:absolute;top:0;left:0;background: #6539B4;content:"";z-index:0}
.fg-line:after{position:absolute;z-index:3;bottom:0;left:0;height:2px;width:0;content:"";-webkit-transition:all;-o-transition:all;transition:all;-webkit-transition-duration:.3s;transition-duration:.3s;background:#6539B4;}
<?php elseif(Option::get('admin_style')=="admin-green"): ?>
body:before{height:50%;width:100%;position:absolute;top:0;left:0;background: #29A176;content:"";z-index:0}
.fg-line:after{position:absolute;z-index:3;bottom:0;left:0;height:2px;width:0;content:"";-webkit-transition:all;-o-transition:all;transition:all;-webkit-transition-duration:.3s;transition-duration:.3s;background:#29A176;}
<?php elseif(Option::get('admin_style')=="admin-blue"): ?>
body:before{height:50%;width:100%;position:absolute;top:0;left:0;background: #0B8DE5;content:"";z-index:0}
.fg-line:after{position:absolute;z-index:3;bottom:0;left:0;height:2px;width:0;content:"";-webkit-transition:all;-o-transition:all;transition:all;-webkit-transition-duration:.3s;transition-duration:.3s;background:#0B8DE5;}
<?php endif ; ?>
</style>
</head>
<body>
<?php doAction('login_ext'); ?>
<div id="login-window">
<form name="f" method="post" action="./index.php?action=login">
	<div class="input-group m-b-20">
		<span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
		<div class="fg-line">
			<input id="username" type="text" class="form-control" name="user" placeholder="用户名" required="" autofocus>
		</div>
	</div>
	<div class="input-group m-b-20">
		<span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
		<div class="fg-line">
			<input id="password" type="password" class="form-control" name="pw" placeholder="密码" required="">
		</div>
	</div>
	<div class="clearfix">
	<?php if($ckcode):?>
           <label class="reg">
           <?php echo $ckcode; ?>
           </label>
      <?php endif ?>			
	</div>
	<div class="checkbox">
		<input id="rememberMe" type="checkbox" class="checkbix" data-text="记住密码" name="ispersis" value="1">
	</div>
	<button id="login-bt" type="submit" class="waves-effect waves-button waves-float"><i class="zmdi zmdi-arrow-forward"></i></button>
</form>
</div>
 <?php if ($error_msg): ?>
<div id="login-tips">
<?php echo $error_msg; ?>
</div>
<?php endif;?>
<script src="./views/plugins/jquery.1.12.4.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/bootstrap-3.3.0/js/bootstrap.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/waves-0.7.5/waves.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/checkbix/js/checkbix.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/app/js/login.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript">
	Checkbix.init();
</script>
</body>
</html>
