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
<li id="tab_plugin" class="cur">
<a href="plugin.php" class="waves-effect waves-light"> 插件管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<?php if(isset($_GET['activate_install'])):?><div class="alert alert-success">插件上传成功，请激活使用</div><?php endif;?>
<?php if(isset($_GET['active'])):?><div class="alert alert-success">插件激活成功</div><?php endif;?>
<?php if(isset($_GET['activate_del'])):?><div class="alert alert-success">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_error'])):?><div class="alert alert-danger">插件激活失败</div><?php endif;?>
<?php if(isset($_GET['inactive'])):?><div class="alert alert-success">插件禁用成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">删除失败，请检查插件文件权限</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger">上传失败，插件目录(content/plugins)不可写</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger">空间不支持zip模块，请按照提示手动安装插件</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger">请选择一个zip插件安装包</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger">安装失败，插件安装包不符合标准</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger">只支持zip压缩格式的插件包</div><?php endif;?>
</div>
</div>
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0">
  <thead>
      <tr>
        <th width="200">名称</th>
        <th width="40" class="tdcenter"><b>状态</b></th>
        <th width="60" class="tdcenter"><b>版本</b></th>
        <th width="450" class="tdcenter hided"><b>描述</b></th>
        <th width="60" class="tdcenter">操作</th>
      </tr>
  </thead>
  <tbody>
    <?php 
    if($plugins):
    $i = 0;
    foreach($plugins as $key=>$val):
        $plug_state = 'inactive';
        $plug_action = 'active';
        $plug_state_des = '点击激活插件';
        if (in_array($key, $active_plugins))
        {
            $plug_state = 'active';
            $plug_action = 'inactive';
            $plug_state_des = '点击禁用插件';
        }
        $i++;
    ?>	
      <tr>
        <td><?php echo $val['Name']; ?></td>
        <td class="tdcenter" id="plugin_<?php echo $i;?>">
        <a href="./plugin.php?action=<?php echo $plug_action;?>&plugin=<?php echo $key;?>&token=<?php echo LoginAuth::genToken(); ?>"><img src="./views/app/img/plugin_<?php echo $plug_state; ?>.gif" title="<?php echo $plug_state_des; ?>" align="absmiddle" border="0"></a>
        </td>
        <td class="tdcenter"><?php echo $val['Version']; ?></td>
        <td class="hided">
        <?php echo $val['Description']; ?>
        <?php if ($val['Url'] != ''):?><a href="<?php echo $val['Url'];?>" target="_blank">更多信息&raquo;</a><?php endif;?>
        <div style="margin-top:5px;">
        <?php if ($val['ForEmlog'] != ''):?>适用于emlog：<?php echo $val['ForEmlog'];?>&nbsp | &nbsp<?php endif;?>
        <?php if ($val['Author'] != ''):?>
        作者：<?php if ($val['AuthorUrl'] != ''):?>
            <a href="<?php echo $val['AuthorUrl'];?>" target="_blank"><?php echo $val['Author'];?></a>
            <?php else:?>
            <?php echo $val['Author'];?>
            <?php endif;?>
        <?php endif;?>
        </div>
        </td>
        <td class="tdcenter">
        <?php if (TRUE === $val['Setting']) {
            echo "<a href=\"./plugin.php?plugin={$val['Plugin']}\" title=\"点击设置插件\">设置</a>";
        } ?>
            <a href="javascript: em_confirm('<?php echo $key; ?>', 'plu', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
        </td>
      </tr>
    <?php endforeach;else: ?>
      <tr>
        <td class="tdcenter" colspan="5">还没有安装插件</td>
      </tr>
    <?php endif;?>
    </tbody>
  </table>
<div>
</div>
</div>
</div>
<div class="form-group" style="padding-top:10px">
<a href="#addplugin" data-toggle="modal" class="btn btn-success">安装插件+</a>
</div>
</div>
<div class="modal fade" id="addplugin" tabindex="-1" role="dialog" aria-labelledby="addpluginLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="zmdi zmdi-close"></i> </button>
<h4 class="modal-title" id="addpluginLabel">添加插件</h4>
</div>
<div class="modal-body">
<form action="./plugin.php?action=upload_zip" method="post" enctype="multipart/form-data" >
	<div class="form-group">
<p> 上传一个zip压缩格式的插件安装包 </p>

<input name="pluzip" type="file" id="input-file-now" class="dropify"  />
            </div>										
<div class="form-group">
<input type="submit" value="上传安装" class="btn btn-primary" />
            <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        </div>
        <div style="margin:10px 0px;">获取更多插件：<a href="store.php">在线商店&raquo;</a></div>
</form>
</div>
</div>
</div>	
</div>
<script>
$("#adm_plugin_list tbody tr:odd").addClass("tralt_b");
$("#adm_plugin_list tbody tr")
    .mouseover(function(){$(this).addClass("trover")})
    .mouseout(function(){$(this).removeClass("trover")})
setTimeout(hideActived,2600);
$("#menu_plug").addClass('active');
</script>
