<?php if(!defined('EMLOG_ROOT')) {exit('error!');}
define('info_url' , 'https://eisongao.github.io/emlog.json' ); 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE); 
curl_setopt($ch,CURLOPT_URL,info_url); 
$value_info = json_decode(curl_exec($ch)); 
define('get_version' , $value_info->version); 
define('get_fixed' , $value_info->fix_bug); 
define('get_date' , $value_info->last_time ); 
define('get_info_cn' , $value_info->info_cn ); 
define('get_down' , $value_info->download_url ); 
define('get_downs' , $value_info->downloads_url ); 
define('get_sql' , $value_info->sql_url ); 
define('get_mysql' , $value_info->mysql ); 
?>
<div class="content_tab">
<div class="tab_left">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-left"></i></a>
</div>
<div class="tab_right">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-right"></i></a>
</div>
<ul id="tabs" class="tabs">
<li id="tab_home">
<a href="./" class="waves-effect waves-light">首页</a>
</li>
<li id="tab_upgrade" class="cur">
<a href="upgrade.php" class="waves-effect waves-light">在线升级</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
 <?php if(get_version > Option::EMLOG_VERSION || get_fixed > 4 ){ ?>
 <div class="row">
  <div class="col-lg-12">
<div class="alert alert-warning">
<?php
echo get_info_cn;
?>
</div>
</div>
</div>
<?php } ?>              
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-devices"></i> 在线升级</div>
        <div class="panel-body">
<div class="panel-wrapper collapse in">
<div class="panel-body row">
<div class="pl-15 pr-15 mb-15">
<div class="pull-left">
<i class="zmdi zmdi-github-alt"></i>
<span class="inline-block txt-dark">当前版本</span>
</div>	
<span class="inline-block txt-warning pull-right weight-500"><?php echo Option::EMLOG_VERSION; ?></span>
<div class="clearfix"></div>
</div>
<hr class="light-grey-hr mt-0 mb-15">
<div class="pl-15 pr-15 mb-15">
<div class="pull-left">
<i class="zmdi zmdi-smartphone-download"></i>
<span class="inline-block txt-dark">自动检测</span>
</div>	
<span class="inline-block txt-danger pull-right weight-500">
<?php if(get_version > Option::EMLOG_VERSION || get_fixed > 4 || get_mysql > 0){ ?>
<?php if(get_mysql > 0 ): ?>
<a  href="./store.php?action=update&type=upd&source=<?php echo get_downs ?>&upsql=<?php echo get_sql ?>&token=<?php echo LoginAuth::genToken(); ?>"> 请点击升级 </a>	
<?php else: ?>
<a  href="./store.php?action=update&type=upd&source=<?php echo get_down ?>&token=<?php echo LoginAuth::genToken(); ?>">请点击升级</a>	
<?php endif ?>
<?php }else{ ?>									
已是最新
<?php } ?>
</span>
<div class="clearfix"></div>
</div>
<hr class="light-grey-hr mt-0 mb-15">
<div class="pl-15 pr-15 mb-15">
<div class="pull-left">
<i class="zmdi zmdi-time"></i>
<span class="inline-block txt-dark">更新时间</span>
</div>	
<span class="inline-block txt-primary pull-right weight-500">
<?php  echo get_date ?>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$("#menu_update").addClass('active');
</script>
