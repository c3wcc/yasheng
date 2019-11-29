<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
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
<li id="tab_data" class="cur">
<a href="data.php" class="waves-effect waves-light">备份恢复</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-success">备份文件删除成功</div><?php endif;?>
<?php if(isset($_GET['active_backup'])):?><div class="alert alert-success">数据备份成功</div><?php endif;?>
<?php if(isset($_GET['active_import'])):?><div class="alert alert-success">备份导入成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger">请选择要删除的备份文件</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger">备份文件名错误(应由英文字母、数字、下划线组成)</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger">服务器空间不支持zip，无法导入zip备份</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger">上传备份失败</duv><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger">错误的备份文件</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger">服务器空间不支持zip，无法导出zip备份</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="links" class="tab-pane fade active in" role="tabpanel">
<form  method="post" action="data.php?action=dell_all_bak" name="form_bak" id="form_bak">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0">
<thead>
    <tr>
      <th width="683" colspan="2"><b>备份文件</b></th>
      <th width="226"><b>备份时间</b></th>
      <th width="149"><b>文件大小</b></th>
      <th width="87">操作</th>
    </tr>
  </head>
  <tbody>
    <?php
        if($bakfiles):
        foreach($bakfiles  as $value):
        $modtime = smartDate(filemtime($value),'Y-m-d H:i:s');
        $size =  changeFileSize(filesize($value));
        $bakname = substr(strrchr($value,'/'),1);
    ?>
    <tr>
      <td width="22"><input type="checkbox" value="<?php echo $value; ?>" name="bak[]" class="ids" /></td>
      <td width="661"><a href="../content/backup/<?php echo $bakname; ?>"><?php echo $bakname; ?></a></td>
      <td><?php echo $modtime; ?></td>
      <td><?php echo $size; ?></td>
      <td><a href="javascript: em_confirm('<?php echo $value; ?>', 'backup', '<?php echo LoginAuth::genToken(); ?>');">导入</a></td>
    </tr>
    <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="5">还没有备份</td></tr>
    <?php endif;?>
    </tbody>
</table>
</div>
</div>
 <div class="form-group">
<div class="list_footer">
操作: <a href="javascript:void(0);" id="select_all">全选</a>  | <a href="javascript:bakact('del');" class="care">删除</a></div>
</div>
</form>
</div>
</div>
<div class="panel panel-default panel-tabs">
<div class="panel-heading">
<div class="pull-left">
<ul role="tablist" class="nav nav-tabs">
<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="backup_tab" href="#backup"> 备份数据库 </a>
</li>
<li role="presentation" class=""><a data-toggle="tab" id="import_tab" role="tab" href="#import" aria-expanded="false"> 导入本地备份 </a></li>
</ul>
</div>	
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="tab-content">						
<div id="backup" class="tab-pane fade active in" role="tabpanel">
<form action="data.php?action=bakstart" method="post">
<div class="form-group">
 <label> 可备份的数据库表 </label>
        <select multiple="multiple" size="12" name="table_box[]" class="form-control">
		<?php foreach($tables  as $value): ?>
		<option value="<?php echo DB_PREFIX; ?><?php echo $value; ?>" selected="selected"><?php echo DB_PREFIX; ?><?php echo $value; ?></option>
		<?php endforeach; ?>
      	</select>
            </div>
<div class="form-group">
 <label> 将站点内容数据库备份到 </label>
        <select name="bakplace" id="bakplace" class="form-control">
 <option value="local" selected="selected"> 本地（自己电脑） </option>
  <option value="server"> 服务器空间 </option>
        </select>
    </div>
<div class="form-group">
<input type="checkbox" style="vertical-align:middle;" value="y" name="zipbak" id="zipbak">
<label for="checkbox6"> 压缩成zip包 </label>
</div>
<div class="form-group text-center">			
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        <input type="submit" value="开始备份" class="btn btn-info"/>
</div>    
</form>											
</div>											
<div id="import" class="tab-pane fade" role="tabpanel">
<form action="data.php?action=import" enctype="multipart/form-data" method="post">
<div class="form-group">
仅可导入相同版本emlog导出的数据库备份文件，且数据库表前缀需保持一致。<br />当前数据库表前缀：<?php echo DB_PREFIX; ?>
<?php echo DB_PREFIX; ?>
</div>
<div class="form-group">
  <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" /> 
   <input type="file" name="sqlfile" id="input-file-now" class="dropify" />   
   </div>    
  <div class="form-group text-center">      
        <input type="submit" value="导入" class="btn btn-warning" />
</div>
</form>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
$(document).ready(function(){
    selectAllToggle();
    $("#adm_bakdata_list tbody tr:odd").addClass("tralt_b");
    $("#adm_bakdata_list tbody tr")
        .mouseover(function(){$(this).addClass("trover")})
        .mouseout(function(){$(this).removeClass("trover")});
    $("#bakplace").change(function(){$("#server_bakfname").toggle();$("#local_bakzip").toggle();});
});
function bakact(act){
    if (getChecked('ids') == false) {
        alert('请选择要操作的备份文件');
        return;
    }
    if(act == 'del' && !confirm('你确定要删除所选备份文件吗？')){return;}
    $("#operate").val(act);
    $("#form_bak").submit();
}
$("#menu_data").addClass('active');
</script>
