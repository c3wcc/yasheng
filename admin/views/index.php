<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class="content_tab">
<div class="tab_left">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-left"></i></a>
</div>
<div class="tab_right">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-right"></i></a>
</div>
<ul id="tabs" class="tabs">
<li id="tab_home" class="cur">
<a href="./" class="waves-effect waves-light">首页</a>
</li>
</ul>
</div>
<div class="content_main">
<div id="iframe_home" class="iframe cur">
<div class="row">
<?php doAction('adm_main_top'); ?>
<?php if (ROLE == ROLE_ADMIN):?>	
<div class="col-lg-12">
<section class="panel panel-default">
<header class="panel-heading"> 
<i class="zmdi zmdi-fire"></i> 欢迎使用EMLOG
</header>				
<div class="widget-container fluid-height ibox-content">

<div class="row">
<div class="col-md-4 welcome-panel">
<h4>开始使用</h4>
<div class="row">
<div class="col-lg-6 col-md-6"><a href="widgets.php" class="btn btn-lg btn-block btn-default">自定义侧边栏</a>
</div>
</div>
<h4>或<a href="template.php">更换主题</a></h4>
</div>
<div class="col-md-4 welcome-panel">
<h4>接下来</h4>
<p><i class="zmdi zmdi-keyboard-hide"></i> <a href="write_log.php">撰写您的想写文章</a></p>
<p><i class="zmdi zmdi-folder-outline"></i> <a href="page.php"> 添加“留言”页面 </a></p>
<p><i class="zmdi zmdi-coffee"></i> <a href="twitter.php">说说看今天的心情咋样</a></p>
</div>
<div class="col-md-4 welcome-panel">
<h4>更多操作</h4>
<p><i class="zmdi zmdi-widgets"></i> <a href="widgets.php">管理边栏小工具</a>和<a href="navbar.php">导航</a></p>
<p><i class="zmdi zmdi-reader"></i> <a href="admin_log.php?pid=draft">管理草稿</a>和<a href="admin_log.php">文章</a></a></p>
<p><i class="zmdi zmdi-store"></i> <a href="store.php">获取更多Emlog主题模版</a></p>
</div>
</div>
</div>
</section>	
</div>
<?php endif; ?>
 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
<div class="panel panel-default card-view pa-0"><div class="panel-wrapper collapse in">
<div class="panel-body pa-0">
<div class="sm-data-box bg-red">
<div class="container-fluid">
<div class="row">
<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
<span class="txt-light block counter"><span class="counter-anim"><?php echo count_user_all() ; ?>
</span>
</span>
<span class="weight-500 uppercase-font txt-light block font-13">
用户
</span>
</div>
<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
<i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i></div>
</div>	
</div></div>
</div>
</div>
</div>
</div><div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"><div class="panel panel-default card-view pa-0">
<div class="panel-wrapper collapse in">
<div class="panel-body pa-0">
<div class="sm-data-box bg-yellow">
<div class="container-fluid">
<div class="row">
<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
<span class="txt-light block counter">
<span class="counter-anim">
<?php if (ROLE == ROLE_ADMIN):?>
<?php echo $sta_cache['comnum_all'];?>
<?php else:?>
<?php echo $sta_cache[UID]['commentnum'];?>
<?php endif; ?>
</span></span>
<span class="weight-500 uppercase-font txt-light block">
评论
</span>
</div>
<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
<i class="zmdi zmdi-comments txt-light data-right-rep-icon"></i>					
</div>
</div>	
</div></div></div>
</div>
</div></div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"><div class="panel panel-default card-view pa-0">
<div class="panel-wrapper collapse in">
<div class="panel-body pa-0">
<div class="sm-data-box bg-green">
<div class="container-fluid">
<div class="row">
<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
<span class="txt-light block counter">
<span class="counter-anim">
<?php if (ROLE == ROLE_ADMIN):?>
<?php echo $sta_cache['lognum'];?>
<?php else:?>
<?php echo $sta_cache[UID]['lognum'];?>
<?php endif; ?>
</span>
</span>
<span class="weight-500 uppercase-font txt-light block">
文章
</span>
</div>
<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
<i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
</div>
</div>	
</div>
</div>
</div>
</div>
</div>
</div><div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"><div class="panel panel-default card-view pa-0"><div class="panel-wrapper collapse in"><div class="panel-body pa-0"><div class="sm-data-box bg-blue">
<div class="container-fluid">
<div class="row">
<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
<span class="txt-light block counter">
<span class="counter-anim">
<?php echo $sta_cache['twnum'];?>
</span>
</span>
<span class="weight-500 uppercase-font txt-light block">
微语
</span>
</div>
<div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
<i class="zmdi zmdi-coffee txt-light data-right-rep-icon"></i>
</div></div>	
</div></div>
</div>
</div>
</div></div></div>
<div class="row">
<div class="col-lg-6">
<section class="panel panel-default">
<header class="panel-heading"> <i class="zmdi zmdi-comment-outline"></i> 最近回复
</header>
<div class="latest-link" id="admindex_servinfo">
<ul class="todo-list m-t small-list">
<?php newcomm() ?>
</ul>
</div>
</section>
</div>
<div class="col-lg-6">
<section class="panel panel-default">
<?php if (ROLE == ROLE_ADMIN):?>
<header class="panel-heading"> <i class="zmdi zmdi-coffee"></i> 最近一语
<?php else : ?>
<header class="panel-heading"> <i class="zmdi zmdi-notifications-none"></i> 站点公告
<?php endif; ?>
</header>
 <div class="latest-link" id="admindex_servinfo">
<ul>
<?php newt() ?>
</ul>
</div>
</section>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel panel-default">
<header class="panel-heading"><i class="zmdi zmdi-laptop"></i> 系统信息
<?php if (ROLE == ROLE_ADMIN):?>
<div class="pull-right">
<a href="index.php?action=phpinfo" target="_blank" class="pull-left inline-block">
<i class="zmdi zmdi-more-vert"></i>
</a>
</div>
<?php endif; ?>
</header>
<table class="table table-bordered">
<tbody>
<tr>
<td>系统程序</td>
<td>Emlog </td>
<td>版本号</td>
<td> <?php echo Option::EMLOG_VERSION; ?> </td>
</tr>
<?php if (ROLE == ROLE_ADMIN):?>
<tr>
<td>数据库表</td>
<td><?php echo DB_NAME; ?></td>
<td>数据库表前缀</td>
<td><?php echo DB_PREFIX; ?></td>
</tr>
<tr>
<td>服务器操作系统</td>
<td><?php echo php_uname('s') ; ?></td>
<td>服务器端口</td>
<td><?php echo $_SERVER["SERVER_PORT"]; ?></td>
</tr>
<tr>
<td>服务器剩余空间</td>
<td><?php echo intval(diskfreespace(".") / (1024 * 1024))."M" ; ?></td>
<td>服务器时间</td>
<td><?php date_default_timezone_set("Asia/Shanghai");echo date("Y-m-d H:i:s");?></td>
</tr>
<tr>
<td>WEB服务器版本</td>
<td><?php echo $_SERVER['SERVER_SOFTWARE'] ; ?></td>
<td>服务器语种</td>
<td><?php echo getenv("HTTP_ACCEPT_LANGUAGE") ; ?></td>
</tr>
<tr>
<td>PHP版本</td><td><?php echo $php_ver; ?></td>
<td>ZEND版本</td><td><?php echo zend_version() ; ?></td>
</tr>
<tr>
<td>脚本运行可占最大内存</td>
<td><?php echo ini_get("memory_limit"); ?></td>
<td>脚本上传文件大小限制</td>
<td><?php echo $uploadfile_maxsize; ?></td>
</tr>
<tr>
<td>POST方法提交限制</td>
<td><?php echo ini_get("post_max_size"); ?></td>
<td>脚本超时时间</td>
<td><?php echo ini_get("max_execution_time"); ?></td>
</tr>
<?php endif; ?>
</tbody>
</table>
</section>
</div>
</div>
</div>
