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
<li id="tab_log" class="cur">
<a href="media.php" class="waves-effect waves-light">附件管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<?php if(isset($_GET['active_del'])):?>
<div class="alert alert-success">
删除成功
</div>
<?php endif;?>
 </div>
 </div>
<div class="panel panel-default">
<div class="panel-heading"> <i class="zmdi zmdi-attachment-alt"></i> 附件管理
</div>
<div class="panel-body">
<form action="attachment.php?action=dell_all_media" method="post" name="form_media" id="form_media">
<?php 
$num_rec_per_page=18; 
if (isset($_GET['page'])) { 
$page=max(1,intval($_GET['page']));
 } else { 
 $page=1;
  }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM " . DB_PREFIX . "attachment where thumfor = 0 order by aid desc  LIMIT $start_from, $num_rec_per_page"; 
$result = $db->query($sql);
if($db->num_rows($result) != 0): 
while ($row = $db->fetch_array($result)){
$extension  = strtolower(substr(strrchr($row['filepath'], "."),1));
$atturl = BLOG_URL.substr($row['filepath'], 3);
/**
*$imgpath = substr($row['filepath'],3,strlen($row['filepath']));
*$imgarr = explode("/",$imgpath);
*$imgsurl = $imgarr[0].'/'.$imgarr[1].'/'.$imgarr[2].'/thum-'.$imgarr[3];
*/
?>
<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
<div class="panel panel-default card-view pa-0">
<div class="panel-wrapper collapse in">
<div class="panel-body pa-0">
<article class="col-item">
<div class="photo">
<img src="<?php if ($extension == 'zip' || $extension == 'rar'){ $imgpath = "./views/app/img/tar.gif";
 ?><?php   echo $imgpath ?><?php }elseif (in_array($extension, array('gif', 'jpg', 'jpeg', 'png', 'bmp'))) { ?><?php echo $atturl ?><?php } ?>" class="img-responsive" style="width:100%;height:100px" alt="<?php echo $row['filename'] ?>" />
</div>
<div class="info">
<h6><input type="checkbox" name="media[<?php echo $row['aid']; ?>]" class="ids" value="1" > <a href="javascript: em_confirm(<?php echo $row['aid']; ?>, 'media', '<?php echo LoginAuth::genToken(); ?>');">删除</a></h6>
</div>
</article>
</div>
</div>	
</div>	
</div>
<?php } ?>
</div>
</div>
<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
<div class=" form-group form-inline" style="padding-top:10px">
    操作: <a href="javascript:void(0);" id="select_all">全选</a> | <a href="javascript:delmedia('');" class="care">删除</a> 
</div>
</div>
</form>
<?php else: ?>
<div class="col-md-12">
<div class="panel panel-default card-view">
<div class="panel-body"> 
<div class="form-group text-center">
没有附件
</div>
</div>
</div>
</div>
<?php endif ?>

<div class="form-group text-center">
 <div id="pagenav">
<?php 
$sql = "SELECT * FROM " . DB_PREFIX . "attachment where thumfor = 0" ;
$rs_result =  $db->query($sql); 
$total_records =  $db->num_rows($rs_result);  
$total_pages = ceil($total_records / $num_rec_per_page);  
for ($i=1; $i<=$total_pages; $i++) { 
if($i==$page){
 echo "<span>".$i."</span>"; 
}else{
 echo "<a href='media.php?page=".$i."'>".$i."</a> "; 
}
}; 
?>
</div>
</div>

<script>
selectAllToggle();	
function delmedia(){
	if (getChecked('ids') == false) {
		alert('请选择要操作的附件');
		return;
	}
	if(!confirm('确定要删除所选的附件吗')){return;}
	$("#form_media").submit();
}
setTimeout(hideActived,2600);				
$("#menu_media").addClass('active');
function em_confirm (id, property, token) {
	switch (property){
	case 'media':
	var urlreturn="attachment.php?action=del_media&aid="+id;
       var msg = "删除该附件吗?";break;
}
	if(confirm(msg)){window.location = urlreturn + "&token="+token;}else {return;}
}			
</script>