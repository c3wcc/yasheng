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
<li id="tab_sort" class="cur">
<a href="sort.php" class="waves-effect waves-light"> 分类管理 </a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
    <?php if (isset($_GET['active_taxis'])): ?><div class="alert alert-success">排序更新成功</div><?php endif; ?>
    <?php if (isset($_GET['active_del'])): ?><div class="alert alert-success">删除分类成功</div><?php endif; ?>
    <?php if (isset($_GET['active_edit'])): ?><div class="alert alert-success">修改分类成功</div><?php endif; ?>
    <?php if (isset($_GET['active_add'])): ?><div class="alert alert-success">添加分类成功</div><?php endif; ?>
    <?php if (isset($_GET['error_a'])): ?><div class="alert alert-danger">分类名称不能为空</div><?php endif; ?>
    <?php if (isset($_GET['error_b'])): ?><div class="alert alert-danger">没有可排序的分类</div><?php endif; ?>
    <?php if (isset($_GET['error_c'])): ?><div class="alert alert-danger">别名格式错误</div><?php endif; ?>
    <?php if (isset($_GET['error_d'])): ?><div class="alert alert-danger">别名不能重复</div><?php endif; ?>
    <?php if (isset($_GET['error_e'])): ?><div class="alert alert-danger">别名不得包含系统保留关键字</div><?php endif; ?>
</div>
</div>
<div class="tab-content">
<div id="sort" class="tab-pane fade active in" role="tabpanel">
<form  method="post" action="sort.php?action=taxis">
<div class="table-wrap ">
<div class="table-responsive">				
<table class="table table-striped table-bordered mb-0" id="adm_sort_list">
<thead>
            <tr>
                <th width="40px"><b>序号</b></th>
                <th><b>名称</b></th>
                <th class="hided"><b>描述</b></th>
                <th class="hided" width="150px"><b>别名</b></th>
                <th class="hided" width="200px"><b>模板</b></th>
                <th class="tdcenter" width="60px"><b>查看</b></th>
                <th class="tdcenter hided" width="80px"><b>文章</b></th>
                <th width="90px">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($sorts):
                foreach ($sorts as $key => $value):
                    if ($value['pid'] != 0) {
                        continue;
                    }
                    ?>
                    <tr>
                        <td width="40">
                            <input type="hidden" value="<?php echo $value['sid']; ?>" class="sort_id" />
                            <input class="form-control em-small" name="sort[<?php echo $value['sid']; ?>]" value="<?php echo $value['taxis']; ?>" />
                        </td>
                        <td class="sortname">
                            <a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></a>
                        </td>
                        <td class="hided"><?php echo $value['description']; ?></td>
                        <td class="alias hided"><?php echo $value['alias']; ?></td>
                        <td class="alias hided"><?php echo $value['template']; ?></td>

                        
                            <td class="tdcenter zmdi-lg" width="10">
        <a href="<?php echo Url::sort($value['sid']); ?>" target="_blank" title="查看分类">
        <i class="zmdi zmdi-window-restore"></i> </a> </a>
        </td>
                        
                        <td class="tdcenter hided"><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><?php echo $value['lognum']; ?></a></td>
                        <td>
                            <a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>">编辑</a>
                            <a href="javascript: em_confirm(<?php echo $value['sid']; ?>, 'sort', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
                        </td>
                    </tr>
                    <?php
                    $children = $value['children'];
                    foreach ($children as $key):
                        $value = $sorts[$key];
                        ?>
                        <tr>
                            <td>
                                <input type="hidden" value="<?php echo $value['sid']; ?>" class="sort_id" />
                                <input class="form-control em-small" name="sort[<?php echo $value['sid']; ?>]" value="<?php echo $value['taxis']; ?>" />
                            </td>
                            <td class="sortname">---- <a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></a></td>
                            <td class="hided"><?php echo $value['description']; ?></td>
                            <td class="alias hided"><?php echo $value['alias']; ?></td>
                            <td class="alias hided"><?php echo $value['template']; ?></td>
                               <td class="tdcenter zmdi-lg">
        <a href="<?php echo Url::sort($value['sid']); ?>" target="_blank" title="查看分类">
        <i class="zmdi zmdi-window-restore"></i> </a> </a>
        </td>
<td width="70">
                                <a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>">编辑</a>
                                <a href="javascript: em_confirm(<?php echo $value['sid']; ?>, 'sort', '<?php echo LoginAuth::genToken(); ?>');" class="care">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach;
            else: ?>
                <tr><td class="tdcenter" colspan="8">还没有添加分类</td></tr>
<?php endif; ?>  
        </tbody>
    </table>
    </div>
    </div>
    <div class="list_footer">
        <input type="submit" value="改变排序" class="btn btn-primary" /> 
        <a href="#addsort" data-toggle="modal" class="btn btn-success">添加分类+</a>
    </div>
</form>
</div>
</div>
</div>									
</div>	
</div>
<div class="modal fade" id="addsort" tabindex="-1" role="dialog" aria-labelledby="addsortLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button"> <i class="zmdi zmdi-close"></i> </button>
<h4 class="modal-title" id="addsortLabel">添加分类</h4>
</div>
<div class="modal-body" >
<form action="sort.php?action=add" method="post"
class="form-horizontal" >
<div class="form-group">
<label class="col-lg-2 control-label">序列号</label>
               <div class="col-lg-10"> 
                <input type="text"  name="taxis" class="form-control  em-small"   >
            </div>											</div>
<div class="form-group">
<label class="col-lg-2 control-label">名称</label>
               <div class="col-lg-10"> 
                <input type="text"  name="sortname" id="sortname" class="form-control"   >
            </div>											</div>
<div class="form-group">
<label class="col-lg-2 control-label">别名</label>
               <div class="col-lg-10"> 
                <input type="text"  name="alias" id="alias" class="form-control"   >
            </div>											</div>
 <div class="form-group">
<label class="col-lg-2 control-label">父分类</label>
               <div class="col-lg-10"> 
                <select name="pid" id="pid" class="form-control">
			<option value="0">无</option>
			<?php
				foreach($sorts as $key=>$value):
					if($value['pid'] != 0) {
						continue;
					}
			?>
			<option value="<?php echo $key; ?>"><?php echo $value['sortname']; ?></option>
			<?php endforeach; ?>
		</select>
            </div>											</div>
            <div class="form-group">
<label class="col-lg-2 control-label">模板</label>
               <div class="col-lg-10"> 
                <input type="text"  name="template" id="template" value="log_list"  class="form-control"   >
            </div>											</div>
            	<div class="form-group">
<label class="col-lg-2 control-label">描述</label>
               <div class="col-lg-10"> 
    <textarea name="description" type="text" class="form-control" style="height:60px;overflow:auto;"></textarea>
            </div>											</div>

            	<div class="form-group">
            	<div class="col-lg-10"> 
          <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
   <input type="submit" class="btn btn-primary" name="" id="addsort" value="添加" /></div>
   </div>					
 </form>
</div>
</div>
</div>									
</div>		
<script>
setTimeout(hideActived, 2600);
    $("#alias").keyup(function() {
        checksortalias();
    });
    function issortalias(a) {
        var reg1 = /^[\w-]*$/;
        var reg2 = /^[\d]+$/;
        if (!reg1.test(a)) {
            return 1;
        } else if (reg2.test(a)) {
            return 2;
        } else if (a == 'post' || a == 'record' || a == 'sort' || a == 'tag' || a == 'author' || a == 'page') {
            return 3;
        } else {
            return 0;
        }
    }
    function checksortalias() {
        var a = $.trim($("#alias").val());
        if (1 == issortalias(a)) {
            $("#addsort").attr("disabled", "disabled");
            $("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
        } else if (2 == issortalias(a)) {
            $("#addsort").attr("disabled", "disabled");
            $("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
        } else if (3 == issortalias(a)) {
            $("#addsort").attr("disabled", "disabled");
            $("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
        } else {
            $("#alias_msg_hook").html('');
            $("#msg").html('');
            $("#addsort").attr("disabled", false);
        }
    }
    $(document).ready(function() {
        $("#adm_sort_list tbody tr:odd").addClass("tralt_b");
        $("#adm_sort_list tbody tr")
                .mouseover(function() {
                    $(this).addClass("trover")
                })
                .mouseout(function() {
                    $(this).removeClass("trover")
                });
        $("#menu_sort").addClass('active');
    });
</script>
