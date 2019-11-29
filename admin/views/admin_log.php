<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
$isdraft = $pid == 'draft' ? '&pid=draft' : '';
$isDisplaySort = !$sid ? "style=\"display:none;\"" : '';
$isDisplayTag = !$tagId ? "style=\"display:none;\"" : '';
$isDisplayUser = !$uid ? "style=\"display:none;\"" : '';
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
<li id="tab_log" class="cur">
<a href="admin_log.php" class="waves-effect waves-light"> <?php if ($pid != 'draft'){ ?>所有文章<?php }else{ ?>临时草稿<?php } ?></a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
 <?php if(isset($_GET['active_del'])):?>
<div class="alert alert-success">删除成功</div>
<?php endif;?>
 <?php if(isset($_GET['active_up'])):?>
<div class="alert alert-success">置顶成功</div>
<?php endif;?>
 <?php if(isset($_GET['active_down'])):?>
<div class="alert alert-success">取消置顶成功</div>
<?php endif;?>
 <?php if(isset($_GET['error_a'])):?>
<div class="alert alert-danger">请选择要处理的文章</div>
<?php endif;?>
 <?php if(isset($_GET['error_b'])):?>
<div class="alert alert-danger ">请选择要执行的操作</div>
<?php endif;?>
 <?php if(isset($_GET['active_post'])):?>
<div class="alert alert-success ">发布成功</div>
<?php endif;?>
<?php if(isset($_GET['active_move'])):?>
<div class="alert alert-success">移动成功</div><?php endif;?>
 <?php if(isset($_GET['active_change_author'])):?>
<div class="alert alert-success">更改作者成功</div><?php endif;?>
 <?php if(isset($_GET['active_hide'])):?>
<div class="alert alert-success">转入草稿箱成功</div>
<?php endif;?>
 <?php if(isset($_GET['active_savedraft'])):?>
<div class="alert alert-success">草稿保存成功</div>
<?php endif;?>
<?php if(isset($_GET['active_savelog'])):?>
<div class="alert alert-success">保存成功</div>
<?php endif;?>
 <?php if(isset($_GET['active_ck'])):?>
<div class="alert alert-success">文章审核成功</div>
<?php endif;?>
 <?php if(isset($_GET['active_unck'])):?>
<div class="alert alert-success">文章驳回成功</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="log" class="tab-pane fade active in">
<form action="admin_log.php?action=operate_log" method="post" name="form_log" id="form_log">
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">	
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered">
<thead>
  <tr>
<th class="tdcenter" width="10px">#</th>
<th>标题</th>
<th class="tdcenter" width="30px">查看</th><th class="tdcenter hided">分类</th>
<th class="tdcenter hided">作者</th>
<th class="hided">时间</th>
<th class="tdcenter hided">评论</th>
<th class="tdcenter hided">阅读</th>
</tr>
</thead>
<tbody>
    <?php
    if($logs):
    foreach($logs as $key=>$value):
    $sortName = $value['sortid'] == -1 && !array_key_exists($value['sortid'], $sorts) ? '未分类' : $sorts[$value['sortid']]['sortname'];
    $author = $user_cache[$value['author']]['name'];
    $author_role = $user_cache[$value['author']]['role'];
    ?>										  <tr>
<td class="tdcenter"><input type="checkbox" name="blog[]" value="<?php echo $value['gid']; ?>" class="ids" /></td>
<td><a href="write_log.php?action=edit&gid=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a>
    <?php if($value['top'] == 'y'): ?> <i class="zmdi zmdi-star" title="文章顶置"></i> <?php endif; ?>
      <?php if($value['sortop'] == 'y'): ?> <i class="zmdi zmdi-star-half" title="分类顶置"></i> <?php endif; ?>
      <?php if($value['attnum'] > 0): ?> <i class="zmdi zmdi-attachment-alt" title="附件：<?php echo $value['attnum']; ?>"></i><?php endif; ?>
      <?php if($pid != 'draft' && $value['checked'] == 'n'): ?><sapn style="color:red;"> - 待审</sapn><?php endif; ?>
      <span style="margin-left:8px;">
        <?php if($pid != 'draft' && ROLE == ROLE_ADMIN && $value['checked'] == 'n'): ?>
        <a href="./admin_log.php?action=operate_log&operate=check&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>">审核</a> 
        <?php elseif($pid != 'draft' && ROLE == ROLE_ADMIN && $author_role == ROLE_WRITER):?>
        <a href="./admin_log.php?action=operate_log&operate=uncheck&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>">驳回</a> 
        <?php endif;?>
      </span>
      </td>
													<td class="tdcenter zmdi-lg" width="60px"> <a href="<?php echo Url::log($value['gid']); ?>" target="_blank" title="在新窗口查看">
<i class="zmdi zmdi-window-restore"></i> </a> </td>
													<td class="tdcenter hided" width="100px"><a href="./admin_log.php?sid=<?php echo $value['sortid'].$isdraft;?>"><?php echo $sortName; ?></a></td>
													<td class="tdcenter hided" width="100px">
<a href="./admin_log.php?uid=<?php echo $value['author'].$isdraft;?>"><?php echo $author; ?>
</a>
</td>
													 <td class="small hided" width="160px"><?php echo $value['date']; ?></td>
													  <td class="tdcenter hided" width="100px"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
      <td class="tdcenter hided" width="100px"><?php echo $value['views']; ?></a></td>
 </tr>
 <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="8"> 还没有文章 </td></tr>
    <?php endif;?>
</tbody>
</table>										
</div>
</div>
<div class="clearfix"></div>						
 <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
    <input name="operate" id="operate" value="" type="hidden" />
    <div class=" form-group form-inline" style="padding-top:10px">
    操作: <a href="javascript:void(0);" id="select_all">全选</a> | <a href="javascript:logact('del');" class="care">删除</a> | 
    <?php if($pid == 'draft'): ?>
    <a href="javascript:logact('pub');">发布</a>
    <?php else: ?>
    <a href="javascript:logact('hide');">转为草稿</a>
     <?php endif;?>
     
     <?php if (ROLE == ROLE_ADMIN):?>
    <select name="top" id="top" onChange="changeTop(this);" class="form-control" style="width:100px">
        <option value="" selected="selected">置顶操作...</option>
        <option value="top">首页置顶</option>
        <option value="sortop">分类置顶</option>
        <option value="notop">取消置顶</option>
    </select>
    <?php endif;?>
<select name="sort" id="sort" onChange="changeSort(this);" style="width:100px;" class="form-control">
    <option value="" selected="selected">转移分类...</option>

    <?php 
    foreach($sorts as $key=>$value):
    if ($value['pid'] != 0) {
        continue;
    }
    ?>
    <option value="<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></option>
    <?php
        $children = $value['children'];
        foreach ($children as $key):
        $value = $sorts[$key];
    ?>
    <option value="<?php echo $value['sid']; ?>">&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
    <?php
    endforeach;
    endforeach;
    ?>
    <option value="-1">未分类</option>
    </select>
<?php if (ROLE == ROLE_ADMIN && count($user_cache) > 1):?>
    <select name="author" id="author" onChange="changeAuthor(this);" style="width:100px;" class="form-control">
    <option value="" selected="selected">更改作者...</option>
    <?php foreach($user_cache as $key => $val):
    $val['name'] = $val['name'];
    ?>
    <option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
    <?php endforeach;?>
    </select>
    <?php endif;?>
        </div>
</form>
</div>
</div>
</div>
<div class="form-group text-center">
<?php if(!empty($pageurl)){ ?>
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
<?php }?>
<div style="text-align:center">
(有<?php echo $logNum; ?>篇<?php echo $pid == 'draft' ? '草稿' : '文章'; ?>)
</div>
</div>
</div>
<script>
$(document).ready(function(){
    selectAllToggle();
});
setTimeout(hideActived,2600);
function logact(act){
    if (getChecked('ids') == false) {
        alert('请选择要操作的文章');
        return;}
    if(act == 'del' && !confirm('你确定要删除所选文章吗？')){return;}
    $("#operate").val(act);
    $("#form_log").submit();
}
function changeSort(obj) {
    if (getChecked('ids') == false) {
        alert('请选择要操作的文章');
        return;}
    if($('#sort').val() == '')return;
    $("#operate").val('move');
    $("#form_log").submit();
}
function changeAuthor(obj) {
    if (getChecked('ids') == false) {
        alert('请选择要操作的文章');
        return;}
    if($('#author').val() == '')return;
    $("#operate").val('change_author');
    $("#form_log").submit();
}
function changeTop(obj) {
    if (getChecked('ids') == false) {
        alert('请选择要操作的文章');
        return;}
    if($('#top').val() == '')return;
    $("#operate").val(obj.value);
    $("#form_log").submit();
}
function selectSort(obj) {
    window.open("./admin_log.php?sid=" + obj.value + "<?php echo $isdraft?>", "_self");
}
function selectUser(obj) {
    window.open("./admin_log.php?uid=" + obj.value + "<?php echo $isdraft?>", "_self");
}
<?php if ($isdraft) :?>
$("#menu_draft").addClass('active');
<?php else:?>
$("#menu_log").addClass('active');
<?php endif;?>
</script>
