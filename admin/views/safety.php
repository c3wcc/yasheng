<?php if (!defined('EMLOG_ROOT')) {exit('error!');}
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
<li id="tab_con" class="cur">
<a href="safety.php" class="waves-effect waves-light"> 站点防护</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
        <?php if (isset($_GET['activated'])): ?><div class="alert alert-success">设置保存成功</div><?php endif; ?>
         <?php if (isset($_GET['rested'])): ?><div class="alert alert-success">重置成功</div><?php endif; ?>
                  <?php if (isset($_GET['dell'])): ?><div class="alert alert-success">清空成功</div><?php endif; ?>
         </div>
         </div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-shield-security"></i> 站点防护
        <div class="pull-right">
已防御(<?php echo $webscan_log ?>)次
</div>
        </div>
<div class="panel-body">
    <form action="safety.php?action=set" method="post" name="input" id="input">
     <div class="form-group">
 <label>
<input value="1" name="webscan_switch" type="checkbox"   id="webscan_switch" <?php echo $webscan_switch; ?> />
启用防跨站攻击漏洞脚本<sup>(推荐火力全开,就是全选)</sup>
</label>
<br>
 <label>
<input value="1" name="webscan_post" type="checkbox"   id="webscan_post" <?php echo $webscan_post; ?> />
拦截POST方式
</label>
<br>
 <label>
<input value="1" name="webscan_get" type="checkbox"   id="webscan_get" <?php echo $webscan_get; ?> />
拦截GET方式
</label>
<br>
 <label>
<input value="1" name="webscan_cookie" type="checkbox"   id="webscan_cookie" <?php echo $webscan_cookie; ?> />
拦截COOKIE方式
</label>
<br>
 <label>
<input value="1" name="webscan_referre" type="checkbox"   id="webscan_referre" <?php echo $webscan_referre; ?> />
拦截REFERRE方式
</label>
</div>
        <div class="form-group">
            <label> 目录白名单<sup>以"|"隔开白名单目录</sup>：</label><textarea name="webscan_white_directory" cols="" rows="3" class="form-control"><?php echo $webscan_white_directory; ?></textarea>
        </div>
                <div class="form-group">
            <label> 小黑屋IP名单<sup> 必须用半角的','分割 </sup>：</label><textarea name="webscan_block_ip" cols="" rows="3" class="form-control"><?php echo $webscan_block_ip; ?></textarea>
        </div>
        
   <div class="form-group form-inline">
<label>
攻击超过<input type="text" name="attacks" maxlength="3" value="<?php echo $attacks; ?>" class="form-control" style="width:50px" /> 次自动加入小黑屋
</label>
</div>           
        
 <div class="form-group">
 <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
   <input type="submit" class="btn btn-success" value="确定" />
   <a class="btn btn-danger"  href="safety.php?action=rest&token=<?php echo LoginAuth::genToken(); ?>">重置统计数</a>
   </div>					
</form>
</div>
</div>

<div class="tab-content">
<div id="safety" class="tab-pane fade active in" role="tabpanel">
<form  method="post" action="safety.php?action=dell_all" name="form_ip" id="form_ip">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered">
<thead>
    <tr>
      <th width="683"><b>攻击来源</b></th>
       <th width="20" class="tdcenter" ><b>次数</b></th>
      <th width="149"><b>时间</b></th>
 </thead>
 <tbody>
 <?php   
      $DB=Database::getInstance();
	$page=max(1,intval($_GET['page']));
	$pagenum=20;
	$count=$DB->once_fetch_array("select count(*) as num from `".DB_PREFIX."block` ");	
        $res = $DB->query("SELECT `id`, `date`, `serverip`,`attack_num` FROM ".DB_PREFIX."block order by date desc limit ".(($page-1)*$pagenum).",$pagenum");
	$pageurl =  pagination($count['num'],$pagenum,$page,"plugin.php?plugin=block_ip-master&page=");
        if($DB->num_rows($res) != 0): 
         while($row = $DB->fetch_array($res)){ ?>
<tr>
<td>
<?php echo $row['serverip'] ?>
</td>
<td class="tdcenter" >
<?php echo $row['attack_num'] ?>
</td>
<td>
<?php echo date("Y-m-d",$row['date']) ?>
</td>
</tr>         
<?php } ?>         
<?php else: ?>      
 <tr><td class="tdcenter" colspan="3">近期非常安全,没人攻击你的小博客</td></tr>
   <?php endif ?>   
    </tbody>
</table>
</div>
</div>
<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
  <input type="submit" value="清空数据" class="btn btn-primary" />      
</form>
</div>
</div>

<?php if(!empty($pageurl)){ ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="form-group text-center">
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
</div>
</div>
</div>			
</div>
</div>
<?php }?>
</div>
</div>
<script>
    setTimeout(hideActived, 2600);
    $("#menu_safety").addClass('active');
</script>