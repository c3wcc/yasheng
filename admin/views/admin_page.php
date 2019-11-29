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
<li id="tab_page" class="cur">
<a href="page.php" class="waves-effect waves-light">页面管理</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
 <div class="col-lg-12">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-success">删除页面成功</div><?php endif;?>
<?php if(isset($_GET['active_hide_n'])):?><div class="alert alert-success">发布页面成功</div><?php endif;?>
<?php if(isset($_GET['active_hide_y'])):?><div class="alert alert-success">草稿页面成功</div><?php endif;?>
<?php if(isset($_GET['active_pubpage'])):?><div class="alert alert-success">页面保存成功</div><?php endif;?>
</div>
</div>
<div class="tab-content">
<div id="page" class="tab-pane fade active in" role="tabpanel">
<form action="page.php?action=operate_page" method="post" name="form_page" id="form_page">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0" id="adm_page_list">
<thead>
  <tr>
        <th class="tdcenter"><b>#</b></th>
        <th><b>标题</b></th>
        <th class="tdcenter" width="60px"><b>查看</b></th>
        <th class="hided" width="120px"><b>模板</b></th>
        <th class="tdcenter" width="80px"><b>评论</b></th>
        <th class="hided" width="150px"><b>时间</b></th>
      </tr>
    </thead>
    <tbody>
    <?php
    if($pages):
    foreach($pages as $key => $value):
    if (empty($navibar[$value['gid']]['url']))
    {
        $navibar[$value['gid']]['url'] = Url::log($value['gid']);
    }
    $isHide = $value['hide'] == 'y' ? 
    '<font color="red"> - 草稿</font>' : 
    '<a href="'.$navibar[$value['gid']]['url'].'" target="_blank" title="查看页面"> <i class="zmdi zmdi-window-restore"></i> </a>';
    ?>
     <tr>
        <td width="21"><input type="checkbox" name="page[]" value="<?php echo $value['gid']; ?>" class="ids" /></td>
        <td width="440">
        <a href="page.php?action=mod&id=<?php echo $value['gid']?>"><?php echo $value['title']; ?></a>   
        <?php if($value['attnum'] > 0): ?> <i class="zmdi zmdi-attachment-alt" title="附件：<?php echo $value['attnum']; ?>"></i> <?php endif; ?>
        </td>
         	<td class="tdcenter zmdi-lg">
        <?php echo $isHide; ?> 
        </td>
        <td class="hided"><?php echo $value['template']; ?></td>
        <td class="tdcenter"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
        <td class="small hided"><?php echo $value['date']; ?></td>
     </tr>
    <?php endforeach;else:?>
      <tr><td class="tdcenter" colspan="5">还没有页面</td></tr>
    <?php endif;?>
</tbody>
</table>										
</div>
</div>
<div class="clearfix"></div>						
  <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
  <input name="operate" id="operate" value="" type="hidden" />
</form>
<div class=" form-group form-inline" style="padding-top:10px">
    操作:
<a href="javascript:void(0);" id="select_all">全选</a> | 
<a href="javascript:pageact('del');" class="care">删除</a> | 
<a href="javascript:pageact('hide');">转为草稿</a> | 
<a href="javascript:pageact('pub');">发布</a>
</div>
<div class="form-group">
<a href="page.php?action=new" class="btn btn-success">新建页面+</a>
</div>
<div class="form-group text-center">
<?php if(!empty($pageurl)){ ?>
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
<?php }?>
<div style="text-align:center">
(有<?php echo $pageNum; ?>个页面)
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    $("#adm_page_list tbody tr:odd").addClass("tralt_b");
    $("#adm_page_list tbody tr")
        .mouseover(function(){$(this).addClass("trover")})
        .mouseout(function(){$(this).removeClass("trover")});
    selectAllToggle();
});
setTimeout(hideActived,2600);
function pageact(act){
    if (getChecked('ids') == false) {
        alert('请选择要操作的页面');
        return;}
    if(act == 'del' && !confirm('你确定要删除所选页面吗？')){return;}
    $("#operate").val(act);
    $("#form_page").submit();
}
$("#menu_pages").addClass('active');
</script>
