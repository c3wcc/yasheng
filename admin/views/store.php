<?php if(!defined('EMLOG_ROOT')) {exit('error!');} 
 $url = './views/data/store.json';
 $file = file_get_contents($url);
 $output = json_decode($file);
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
<li id="tab_store" class="cur">
<a href="store.php" class="waves-effect waves-light">在线商店</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
 <div class="row">
  <div class="col-lg-12">
<div class="alert alert-warning">
提示:我会不定期的更新数据!但要我有空的时候才弄咯
</div>
</div>
</div>
<div class="form-group">
<form action="store.php" method="get" id="search-form">
<div class="input-group">
<input id="keywords" type="text" name="keyword" class="form-control" placeholder="搜索插件和模板"/>
<div class="input-group-btn">
<button type="submit" class="btn btn-default"><span class="zmdi zmdi-search"></span></button>
        </div>
        </div>
 <form>
</div>

<div class="panel panel-default panel-tabs">
<div class="panel-heading">
<div class="pull-left">
<ul role="tablist" class="nav nav-tabs">
<?php if(isset($_GET["keyword"])){?>	
<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="search" href="#search"> 搜索 </a>
</li>
<?php }else{ ?>
<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="tpls_tab" href="#tpls"> 模板 </a>
</li>
<li role="presentation" class=""><a data-toggle="tab" id="plugins_tab" role="tab" href="#plugins" aria-expanded="false"> 插件 </a></li>
<?php } ?>
</ul>
</div>	
<div class="pull-right">
<ul class="nav nav-tabs">
 <li> <a href="./store.php?action=insupdata&type=data&source=<?php echo $site_store_data  ?>&token=<?php echo LoginAuth::genToken(); ?>">更新数据</a></li>
 </ul>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="tab-content">		

<?php if(isset($_GET["keyword"])){?>		
<div id="search" class="tab-pane fade active in" role="tabpanel">
<div class="table-wrap ">				
<table class="table table-striped table-bordered mb-0">
<thead>
<tr>
<th class="tdcenter">#</th>
<th>名称</th>
<th class="tdcenter hided">作者</th>
<th class="tdcenter">预览</th>
<th class="tdcenter">版本</th>
<th class="tdcenter hided">更新时间</th>
<th class="tdcenter">操作</th>
</tr>
</thead>
<tbody>
<?php
$json = file_get_contents($url);
$arr = json_decode(trim($json, chr(239) . chr(187) . chr(191)), true);
$id = array_column($arr, 'id', 'username');
$username = array_column($arr, 'username', 'username');
$preview = array_column($arr, 'pic', 'username');
$author = array_column($arr, 'name', 'username');
$dess = array_column($arr, 'des', 'username');
$banpen = array_column($arr, 'version', 'username');
$time = array_column($arr, 'date', 'username');
$down = array_column($arr, 'remark', 'username');
$i= $id[$_GET['keyword']];
$username=  $username[$_GET['keyword']];
$name= $author[$_GET['keyword']];
$pic= $preview[$_GET['keyword']];
$des= $dess[$_GET['keyword']];
$version = $banpen[$_GET['keyword']];
$date = $time[$_GET['keyword']];
$remark = $down[$_GET['keyword']];
?>								
<?php if(!empty($i)) : ?>							
<tr role="row" class="even">
<td class="tdcenter"><?php echo $i ?></td>
<td style="text-transform:capitalize;"><?php echo $username; ?></td>
<td class="tdcenter hided"><?php echo $name; ?></a></td>
<td class="tdcenter zmdi-lg"><a href="#prews_<?php echo $i ?>" data-toggle="modal" >
<i class="zmdi zmdi-laptop"></i>
</td>
<div class="modal fade" id="prews_<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="prews_<?php echo $i ?>Label" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">预览</h4>
</div>
<div class="modal-body">
<div class="testimonial-wrap  tdcenter ">
<img src="<?php echo $pic  ?>" style="width:150px;height:150px"> 
<div>
<hr>
<div style="padding-top:-10px">
<div class="alert alert-warning">
<?php echo $des  ?>
 </div>
</div>
</div>
</div>
</div>
</div>
<td class="tdcenter"><?php echo $version  ?></td>	
<td class="tdcenter hided"><?php echo $date  ?>	</td>
<td class="tdcenter"><a href="./store.php?action=insplu&type=plu&source=<?php echo $remark  ?>&token=<?php echo LoginAuth::genToken(); ?>">安装</a></td>
</tr>
<?php else : ?>		
<tr>	
<td class="tdcenter" colspan="8">商店里没有该物品</td>
</tr>
<?php endif ?>		
</tbody>
</table>
</div>
</div>	
<?php }else{ ?>									
<div id="tpls" class="tab-pane fade active in" role="tabpanel">
<div class="table-wrap ">				
<table class="table table-striped table-bordered mb-0">
<thead>
<tr>
<th class="tdcenter">#</th>
<th>名称</th>
<th class="tdcenter hided">作者</th>
<th class="tdcenter">预览</th>
<th class="tdcenter">版本</th>
<th class="tdcenter hided">更新时间</th>
<th class="tdcenter">操作</th>
</tr>
</thead>
<tbody>				
<?php
if (!empty($output)) :
$i=1;
foreach ($output as $repo) :
if($repo->type!="tpl")continue;
 ?>					
<tr role="row" class="even">
<td class="tdcenter"><?php echo $i ?></td>
<td style="text-transform:capitalize;"><?php echo $repo->username; ?></td>
<td class="tdcenter hided"><?php echo $repo->name; ?></a></td>
<td class="tdcenter zmdi-lg"><a href="#prew_<?php echo $i ?>" data-toggle="modal" >
<i class="zmdi zmdi-laptop"></i>
</td>
<div class="modal fade" id="prew_<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="prew_<?php echo $i ?>Label" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">预览</h4>
</div>
<div class="modal-body">
<div class="testimonial-wrap  tdcenter ">
<img src="<?php echo $repo->pic  ?>" style="width:150px;height:150px"> 
<div>
<hr>
<div style="padding-top:-10px">
<div class="alert alert-warning">
<?php echo $repo->des  ?>
 </div>
</div>
</div>
</div>
</div>
</div>
<td class="tdcenter"><?php echo $repo->version  ?></td>	
<td class="tdcenter hided"><?php echo $repo->date  ?>	</td>
<td class="tdcenter"><a href="./store.php?action=instpl&type=tpl&source=<?php echo $repo->remark  ?>&token=<?php echo LoginAuth::genToken(); ?>">安装</a></td>
</tr>
<?php 
$i++;
endforeach;
else:
?>
<tr>	
<td class="tdcenter" colspan="8">商店里啥都没有</td>
</tr>
<?php endif;?>	
</tbody>
</table>
</div>
</div>							
								
<div id="plugins" class="tab-pane fade" role="tabpanel">
<div class="table-wrap ">				
<table class="table table-striped table-bordered mb-0">
<thead>
<tr>
<th class="tdcenter">#</th>
<th>名称</th>
<th class="tdcenter hided">作者</th>
<th class="tdcenter">预览</th>
<th class="tdcenter">版本</th>
<th class="tdcenter hided">更新时间</th>
<th class="tdcenter">操作</th>
</tr></thead>
<tbody>				
<?php
if (!empty($output)) :
$i=1;
foreach ($output as $repo) :
if($repo->type!="pls")continue;
 ?>					
<tr role="row" class="even">
<td class="tdcenter"><?php echo $i ?></td>
<td style="text-transform:capitalize;"><?php echo $repo->username; ?></td>
<td class="tdcenter hided"><?php echo $repo->name; ?></a></td>
<td class="tdcenter zmdi-lg"><a href="#prews_<?php echo $i ?>" data-toggle="modal" >
<i class="zmdi zmdi-laptop"></i>
</td>
<div class="modal fade" id="prews_<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="prews_<?php echo $i ?>Label" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">预览</h4>
</div>
<div class="modal-body">
<div class="testimonial-wrap  tdcenter ">
<img src="<?php echo $repo->pic  ?>" style="width:150px;height:150px"> 
<div>
<hr>
<div style="padding-top:-10px">
<div class="alert alert-warning">
<?php echo $repo->des  ?>
 </div>
</div>
</div>
</div>
</div>
</div>
<td class="tdcenter"><?php echo $repo->version  ?></td>	
<td class="tdcenter hided"><?php echo $repo->date  ?>	</td>
<td class="tdcenter"><a href="./store.php?action=insplu&type=plu&source=<?php echo $repo->remark  ?>&token=<?php echo LoginAuth::genToken(); ?>">安装</a></td>
</tr>
<?php 
$i++;
endforeach;
else:
?>
<tr>	
<td class="tdcenter" colspan="8">商店里啥都没有</td>
</tr>
<?php endif;?>
</tbody>
</table>
</div>							
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
</script>