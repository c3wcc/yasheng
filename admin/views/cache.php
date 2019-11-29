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
<li id="tab_cache" class="cur">
<a href="cache.php" class="waves-effect waves-light">更新缓存</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
<?php if(isset($_GET['active_mc'])):?>
<div class="alert alert-success">
缓存更新成功
</div>
<?php endif;?>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-traffic"></i> 系统缓存
        </div>
<div class="panel-body">
<div class="panel-wrapper collapse in">
<div class="panel-body row">
<p>缓存可以加快站点的加载速度。通常系统会自动更新缓存，无需手动。有些特殊情况，比如缓存文件被修改、手动修改过数据库、页面出现异常等才需要手动更新</p>
</div>
<div id="cache">
<div class="form-group">
<button type="button" onclick="window.location='cache.php?action=Cache'" class="btn btn-success" /> 更新缓存</button>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-bike"></i> 优化数据
        </div>
<div class="panel-body">
<div class="table-wrap ">
<div class="table-responsive">	
<table class="table table-striped table-bordered mb-0" id="optimized">
<thead>
  <tr>
<th><b>数据表</b></th>
<th class="tdcenter"><b> 大小</b></th>
<th class="tdcenter"><b> 记录</b></th>
<th class="tdcenter"><b> 沉余</b></th>
 </tr>
 </thead>
 <tbody>
 <?php
 $tables = array();
 $result = $DB->query("SHOW TABLE STATUS");
 $tot =0; 
 $rs =0;
 $nrs=0;
while($row = $DB->fetch_array($result)) {
 $total_size = $row[ "Data_length" ] +  $row[ "Index_length" ];$gain= $row['Data_free'];
$total_gain += $gain;
$gain = round ($gain,2);$tbl = $row['Name'];
$rs++;
$tot = $tot + $total_size;?><tr>
<td> <?php echo $tbl?></td>
<td class="tdcenter"> <?php echo format_size($total_size);?></td>
<td class="tdcenter">
<?php
      $q=("select * from $tbl");
      $rez= $DB-> query($q);
      echo $rowss= $DB-> num_rows($rez);
      $nrs =$nrs +$rowss;?>
</td>
<?php 
if ($gain == 0){
?>
<td class="tdcenter">
 0 KiB
</td>
<?php }else{ ?>
<td class="tdcenter" style=\"color: #ff0000;\">
<?php echo format_size($gain) ?>
<?php } ?>
</tr>
<?php }?>
 <tr>
 <td>总共<sup><?php echo $rs ?> </sup></td>
<td> <?php echo format_size($tot);?> </td>
   <td> <?php echo $nrs ?> </td>
  <td> <?php echo format_size($total_gain);?> </td>
  </tr>
</tbody>
</table>
 </div> 
 </div> 
 </div>
<div id="cache">
<div class="form-group tdcenter">
<button type="button" id="opt" class="btn btn-danger" /> 开始优化</button>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
setTimeout(hideActived,2600);
$("#menu_cache").addClass('active');
$(document).on("click","#opt",function(){
$("#optimized").html(' <tbody> <td><i class="zmdi zmdi-spinner"></i> 优化中.... </td> </tbody>');	
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
document.getElementById("optimized").innerHTML=xmlhttp.responseText;
    }
  }
var url="";
url="cache.php?action=suc&token=<?php echo LoginAuth::genToken(); ?>";
xmlhttp.open("GET",url,true);
xmlhttp.send();	
})
</script>

