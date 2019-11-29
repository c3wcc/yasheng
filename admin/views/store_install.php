<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
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
<li id="tab_store" class="cur">
<a href="store.php" class="waves-effect waves-light">在线商店</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-traffic"></i> 安装<?php echo $source_typename;?>
        </div>
<div class="panel-body">
<div class="panel-wrapper collapse in">
<div class="panel-body row">
<div id="addon_ins"><span class="ajaxload"><?php echo $source_typename;?>正在下载安装中,请耐心等待 <i class="zmdi zmdi-spinner"></i> </span></div>
</div>
</div>
  <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" /> 
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    $.get('./store.php', {
    action:'addon', 
    source:"<?php echo $source;?>",
     type:"<?php echo $source_type;?>"
      },
      function(data){
        if (data.match("succ")) {
            $("#addon_ins").html('<span id="addonsucc"><?php echo $source_typename;?>安装成功，<?php echo $source_typeurl;?></span>');
        } else if(data.match("error_down")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>下载失败，可能是服务器网络问题,请联系开发者， <a href="store.php">返回在线商店</a></span>');
        } else if(data.match("error_zip")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，可能是你的服务器空间不支持zip模块，请手动下载安装，<a href="store.php">返回在线商店</a></span>');
        } else if(data.match("error_dir")){
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，可能是应用目录不可写，<a href="store.php">返回在线商店</a></span>');
        }else{
            $("#addon_ins").html('<span id="addonerror"><?php echo $source_typename;?>安装失败，<a href="store.php">返回在线商店</a></span>');
        }
      });
})
</script>
