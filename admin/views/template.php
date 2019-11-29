<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>
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
<li id="tab_temp" class="cur">
<a href="template.php" class="waves-effect waves-light"> 模板管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body" id="container">
<div class="row">
<div class="col-lg-12" >
<div class="container-fluid"></div>
<?php if (isset($_GET['activated'])): ?><div class="alert alert-success">模板更换成功</div><?php endif; ?>
<?php if (isset($_GET['activate_install'])): ?><div class="alert alert-success">模板上传成功</div><?php endif; ?>
<?php if (isset($_GET['activate_del'])): ?><div class="alert alert-success">删除模板成功</div><?php endif; ?>
<?php if (isset($_GET['error_a'])): ?><div class="alert alert-danger">删除失败，请检查模板文件权限</div><?php endif; ?>
<?php if (!$nonceTplData): ?><div class="alert alert-danger">当前使用的模板(<?php echo $nonce_templet; ?>)已被删除或损坏，请选择其他模板。</div><?php endif; ?>
<div id="msg"></div>
</div>
</div>
    <div class="containertitle2 panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-puzzle-piece"></i> 模板管理
        </div>
<div class="panel-body">
<div class="col-lg-12">
<div class="heading-bg icard-views">
<div class="theme-browser">
<?php if(!$nonceTplData): ?>
<div class="actived alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
正在使用(<?php echo $nonce_templet; ?>) 已被删除或损坏，请选择其他模板
</div>
<?php else:?>
<div class="tpl_list theme_ntpls theme active">
	<div class="theme-preview">
	<div class="theme-screenshot">
	<img src="<?php echo TPLS_URL.$nonce_templet; ?>/preview.jpg" alt=""  data-toggle="modal"  data-target=".tpl-used" >
	</div>
	</div>
<h2 class="theme-names">
<?php echo $tplName; ?>
</h2>
<div class="theme-used">正在使用</div>	
</div>
<div class="modal fade tpl-used" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-ms">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="zmdi zmdi-close"></i> </button>
<h5 class="modal-title"><?php echo $tplName; ?>
<sup><?php echo $tplVer; ?></h5>
</div>
<div class="modal-body">
<div class="alert alert-warning">
<?php if($tplForEm) {?>
<?php echo $tplForEm ?> <br>
<?php } ?>
<?php echo $tplAuthor; ?><br>
<?php if($tplDes) {?>
	  <?php echo $tplDes; ?>
	  <?php }else{ ?>
	  <?php echo $themedss; ?>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
    <?php
    foreach ($tpls as $key => $value):
    if ($value['tplfile']==$nonce_templet) continue;
    ?>
<div class="theme <?php if($nonce_templet == $value['tplfile']){echo "active";} ?>">
	<div class="theme-screenshot">
	<img src="<?php echo TPLS_URL . $value['tplfile']; ?>/preview.jpg" alt="" data-toggle="modal"  data-target=".tpl-<?php echo $value['tplfile']?>" >
	</div>	
<h2 class="theme-names"><?php echo $value['tplname']; ?></h2>
	<div class="theme-action">
<a class="btn btn-danger care" href="javascript: em_confirm('<?php echo $value['tplfile']; ?>', 'tpl', '<?php echo LoginAuth::genToken(); ?>');">删除</a>
</div>	
</div>
<div class="modal fade tpl-<?php echo $value['tplfile']?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-ms">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="zmdi zmdi-close"></i> </button>
<h5 class="modal-title"><?php echo $value['tplname']; ?>
<sup><?php echo $value['Version']; ?></h5>
</div>
<div class="modal-body">
<div class="form-group">	
<div class="alert alert-warning">
<?php echo $value['tplForEm']; ?><br/>
<?php echo $value['Author']; ?><br/>
<?php echo $value['Des']; ?>
</div>
</div>
<div class="form-group text-center">	
<a class="btn btn-primary" href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>&token=<?php echo LoginAuth::genToken(); ?>">启用</a><a class="btn btn-info" href="../?theme=<?php echo $value['tplfile']; ?>" target="_blank">预览</a>
</div>
</div>
</div>
</div>
</div>
<?php endforeach;?>
<div class="theme add-new-theme">
<a href="./template.php?action=install">
<div class="theme-screenshot"><span></span>
</div>
<h2 class="theme-name">添加</h2>
</a>
</div>
</div>
<div class="theme-overlay"></div>
</div>
<?php doAction('adm_sets');?>
<script>
setTimeout(hideActived,2600);
$("#menu_tpl").addClass('active');
</script>